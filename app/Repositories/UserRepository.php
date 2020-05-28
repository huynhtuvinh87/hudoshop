<?php

namespace App\Repositories;

use App\User;
use App\Contracts\UserInterface;
use Exception;
use Illuminate\Support\Str;
use Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Config;
use Constants;
use DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserRepository implements UserInterface
{


    protected $_user;
    protected $_category;
    protected $_passwordReset;
    protected $_resetPasswordRequest;
    public function __construct()
    {

        $this->_category = new Category();
        $this->_user = new User();
        $this->_passwordReset = new PasswordReset();
    }

    /**
     * Get list Employee
     * @author huynhtuvinh87@gmail.com
     */
    public function list($request)
    {

        try {
            $query = $this->_user->select(
                DB::raw('users.*')
            )->orderBy('id', 'desc');
            if ($request->search) {
                $query = $query->where('name', 'LIKE', '%' . $request->search . '%');
                $query = $query->orWhere('username', 'LIKE', '%' . $request->search . '%');
                $query = $query->orWhere('email', 'LIKE', '%' . $request->search . '%');
            }
            if ($request->status) {
                return $query->where('status', $request->status)->paginate($request->limit);
            }
            return $query->where('status', '!=', config('global.status.trash'))->where('id', '!=', Auth::user()->id)->paginate($request->limit);
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function register($request)
    {
        try {
            $result = $this->_user->create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'access_token' => Str::random(64)
            ]);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update($id, $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'role' => $request->role,
                'status' => $request->status
            ];
            if ($request->check_password) {
                $data = array_merge(
                    $data,
                    ['password' => Hash::make($request->password)]
                );
            }
            $result = $this->_user->where('id', $id)->update($data);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function updateMember($id, $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone
            ];
            if ($request->check_password) {
                $data = array_merge(
                    $data,
                    ['password' => Hash::make($request->password)]
                );
            }
            $result = $this->_user->where('id', $id)->update($data);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function changePassword($id, $request)
    {
        try {
            $result = $this->_user->where('id', $id)->update([
                'password' => Hash::make($request->password)
            ]);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function checkPassword($request)
    {
        try {
            $query = $this->_user->where(['email' => $request->email, 'question' => $request->question, 'answer' => $request->answer])->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function checkToken($email, $token)
    {
        try {
            $query = $this->_passwordReset->where(['email' => $email, 'token' => $token])->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function confirmPassword($request)
    {
        try {
            if ($this->checkToken($request->email, $request->token)) {
                $result = $this->_user->where('email', $request->email)->update([
                    'password' => Hash::make($request->password)
                ]);
                $this->_passwordReset->where('email', $request->email)->update([
                    'token' => bcrypt(Str::random(60))
                ]);
                return $result;
            }
            return false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function view($token)
    {
        try {
            $query = $this->_user->select('id', 'access_token')->where('access_token', $token)->first();
            return $query;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateToken($email)
    {
        try {
            $token = bcrypt(Str::random(60));
            $result = $this->_passwordReset->where('email', $email)->update([
                'token' => $token
            ]);
            return $token;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getUser($id)
    {
        try {
            $query = $this->_user->select('id', 'avatar', 'name', 'email', 'address', 'birthday', 'phone')->where('id', $id)->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function createToken($email)
    {
        try {
            $user = $this->_user->select('*')->where('email', $email)->firstOrFail();
            $passwordReset = $this->_passwordReset->updateOrCreate([
                'email' => $user->email,
            ], [
                'token' => Str::random(60),
            ]);
            return ['user' => $user, 'passwordReset' => $passwordReset];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function uploadBase64($image)
    {
        try {
            $image = str_replace('data:image/png;base64,', '', $image);

            $image = str_replace(' ', '+', $image);
            $imageName =  Str::slug(Auth::user()->name, '-') . '.png';
            \File::put(public_path('uploads/' . $imageName), base64_decode($image));
            list($width, $height, $type, $attr) = getimagesize(public_path('uploads/' . $imageName));
            if ($width != NULL) {
                $img = \Image::make('uploads/' . $imageName);
                $img->resize(200, 200);
                $img->save(public_path('uploads/thumbnails/' . $imageName));
                $url = env('APP_DOMAIN') . '/uploads/' . $imageName;
                $result = $this->_user->where('id', Auth::user()->id)->update([
                    'avatar' => $url
                ]);
                return Auth::user();
            }
            return  false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function upload($file)
    {
        try {
            // $watermark = \Image::make(public_path('watermark.png'));
            $file->move('uploads', $file->getClientOriginalName());
            $img = \Image::make('uploads/' . $file->getClientOriginalName());
            // $img->insert($watermark, 'bottom-right', 10, 10);
            // $img->save(public_path('uploads/' . $file->getClientOriginalName()));
            $img->resize(200, 200);
            $img->save(public_path('uploads/thumbnails/' . $file->getClientOriginalName()));
            $url = env('APP_DOMAIN') . '/uploads/' . $file->getClientOriginalName();
            $this->_user->where('id', Auth::user()->id)->update([
                'avatar' => $url
            ]);
            return Auth::user();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function trash($id)
    {
        try {
            $result = $this->_user->where('id', $id)->update([
                'status' => config('global.status.trash')
            ]);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->_user->where('id', $id)->delete();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get view
     * @author huynhtuvinh87@gmail.com
     */
    public function find($id)
    {
        try {
            $query = $this->_user->select('*')->where('id', $id)->first();
            return $query;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
