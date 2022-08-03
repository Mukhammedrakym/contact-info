<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Sign In</div>
        <div class="card-body">
            <form action="/user/login" method="POST" class="space-y-5 mt-5">
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="text" name="email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="form-group">
                    <a href="/forgot" class="">Forgot password?</a>
                </div>
                <div class="form-group">
                    <a href="/user/register" class="">Registration</a>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </form>
        </div>
    </div>
</div>
