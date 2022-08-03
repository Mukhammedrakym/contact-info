<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Registration</div>
        <div class="card-body">
            <form action="/user/register" method="POST" class="space-y-5 mt-5">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="text" name="email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="form-group">
                    <label>Confirm password</label>
                    <input class="form-control" type="password" name="password_confirm">
                </div>
                <div class="form-group">
                    <a href="/user/login" class="">Already have an account?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
            </form>
        </div>
    </div>
</div>