<form action="<?= $login_action ?>" method="post" id="login">
    <div class="form-group">
        <label for="username">Nome de Usuário: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="form-group">
        <label for="password">Senha: <span class="text-danger">*</span></label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <!--<div class="form-group">
    <div class="form-check">
        <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="remember" id="remember"> Lembrar-me
        </label>
    </div>
    </div>-->
    <button type="submit" class="btn btn-primary" id="btnLogin">Logar</button>
</form>
