<?php
// var_dump($_POST);

require_once 'init.php';
// var_dump($_POST);

if (Input::exists()) { // check input
    if (Token::check(Input::get('token'))) { // check token
        $user = new User;
        $validate = new Validate();
        
        $validate->check($_POST, [
            'current_password' => ['required' => true, 'min' => 6],
            'new_password' => ['required' => true, 'min' => 6],
            'confirm_new_password' => ['required' => true, 'min' => 6, 'matches' => 'new_password']
        ]);
        if ($validate->passed()) {
            // $currentPassword = isset($_POST['current_password']) ? $_POST['current_password'] : '';
            // $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : '';
            // $confirmNewPassword = isset($_POST['confirm_new_password']) ? $_POST['confirm_new_password'] : '';
            
            if (password_verify(Input::get('current_password'), $user->data()->password)) {
                $user->update(['password' => password_hash(Input::get('new_password'), PASSWORD_DEFAULT)]);
                Session::flash('success', 'Password has been updated! ');
                Redirect::to('index.php');
                // var_dump(password_verify($password, $this->data->password));exit; //bool: 
            } else {
                echo 'Invalid current password';
            }
        } else {
            foreach ($validate->errors() as $error) {
                echo $error . '<br>';
            }
        }
    }   
}

?>

<form action="" method="post">
    
    <div class="field">
        <label for="current_password">Current password</label>
        <input name="current_password" type="password" id="current_password">
    </div>
    <div class="field">
        <label for="new_password">New password</label>
        <input name="new_password" type="password" id="new_password">
    </div>

    <div class="field">
        <label for="confirm_new_password">Confirm new password</label>
        <input name="confirm_new_password" type="password" id="confirm_new_password">
    </div>

    <div class="field">
        <button type="submit">Submit</button>
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>
