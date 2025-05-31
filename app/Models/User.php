<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use App\Models\user_has_refs;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'profile_photo_url',
        'coin',
        'reference',
        'reference_accepted_at',
        'active_nav',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * give user default 'user' role 
     * when model is created
     */
    protected static function boot(): void
    {
        parent::boot();

        static::created(function (User $user) {
            // give an default role
            $user->syncRoles('user');
            $user->coin = 0;
            $user->profile_photo_url = 'https://source.unsplash.com/random';

            // permission to access user pane.
            $user->syncPermissions('access_users_dashboard');

            /**
             * create a reff code, if comission is turn on to config
             */

            if (config('app.comission')) {
                $length = strlen($user->id);

                if ($length >= 4) {
                    $ref = $user->id;
                } else {
                    $ref = str_pad($user->id, 4, '0', STR_PAD_LEFT);
                }
                user_has_refs::create(
                    [
                        'user_id' => $user->id,
                        'ref' => date('ym') . $ref,
                        'status' => 1,
                    ]
                );
            }

            $user->save();
        });
    }

    /**
     * scope method 
     */
    public function scopeWithAdmin($query)
    {
        return $query->where('email', '=', config('app.system_email'));
    }
    public function scopeWithoutAdmin($query)
    {
        return $query->where('email', '!=', config('app.system_email'));
    }

    /**
     * Determined the user hold the specific permissions
     */
    public function ableTo($permission)
    {
        return $this->permisions()->contains($permission);
    }

    protected function permisions()
    {
        return $this->getPermissionNames();
    }




    //////////////// 
    // Relations //
    ///////////////


    /**
     * @return reff_code
     */
    public function getRef()
    {
        return $this->hasOne(user_has_refs::class)->withDefault([
            'ref' => null,
        ]);
    }

    /**
     * @return reffered_user
     */
    public function getReffOwner()
    {
        return $this->belongsTo(user_has_refs::class, 'reference', 'ref')->withDefault([
            'ref' => null,
        ]);
    }

    /**
     * @return the referred user
     */
    public function referred()
    {
        return User::where(['refernce' => $this->referene]);
    }


    public function requestsToBeVendor()
    {
        return $this->hasMany(vendor::class);
    }
    public function requestsToBeReseller()
    {
        return $this->hasMany(reseller::class);
    }
    public function requestsToBeRider()
    {
        return $this->hasMany(rider::class);
    }


    public function isVendor()
    {
        return $this->requestsToBeVendor()?->where(['status' => 'Active'])->first();
    }
    public function isReseller()
    {
        return $this->requestsToBeReseller()?->where(['status' => 'Active'])->first() ? true : false;
    }
    public function isRider()
    {
        return $this->requestsToBeRider()?->where(['status' => 'Active'])->first();
    }

    public function resellerShop()
    {
        return $this->requestsToBeReseller()?->where(['status' => 'Active'])->first();
    }
    public function vendorShop()
    {
        return $this->requestsToBeVendor()?->where(['status' => 'Active'])->first();
    }




    private function papp()
    {
        return $this->hasMany(Product::class);
    }

    public function account_type()
    {
        $account = '';
        $roles = auth()->user()->getRoleNames();
        // dd($roles);
        if (count($roles) > 2) {
            $account = auth()->user()->active_nav;
        } else {

            $account = auth()->user()->isVendor() ? 'vendor' : 'reseller';
        }

        return $account;
    }


    public function myProducts()
    {
        return $this->papp()->where(['belongs_to_type' => $this->account_type()]);
    }

    // public function myProductsAsVendor()
    // {
    //     return $this->papp()->where(['belongs_to_type' => 'vendor']);
    // }
    // public function myProductsAsReseller()
    // {
    //     return $this->papp()->where(['belongs_to_type' => 'reseller']);
    // }


    private function myCt()
    {
        return $this->hasMany(Category::class);
    }

    public function myCategory()
    {
        return $this->myCt()->where(['belongs_to' => $this->account_type()]);
    }

    // public function myCategoryAsVendor()
    // {
    //     return $this->myCt()->where(['belongs_to' => 'vendor']);
    // }
    // public function myCategoryAsReseller()
    // {
    //     return $this->myCt()->where(['belongs_to' => 'reseller']);
    // }


    private function uct()
    {
        return $this->hasMany(cart::class);
    }

    public function myCarts()
    {
        return $this->uct()->where(['user_type' => 'user']);
    }

    public function myCartsAsReseller()
    {
        return $this->uct()->where(['user_type' => 'reseller']);
    }

    private function myOr()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function myOrderAsUser()
    {
        $this->myOr()->where(
            [
                'belongs_to_type' => 'reseller'
            ]
        );
    }
    public function orderToMe()
    {
        // return $this->hasMany(Order::class);
        return Order::where(['belongs_to' => auth()->user()->id]);
    }


    /**
     * vip package
     * @return vip 
     */
    public function subscription()
    {
        return $this->hasMany(vip::class);
    }
}
