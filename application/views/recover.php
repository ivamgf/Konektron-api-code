<?php echo form_open('recover/'.$token, [ 'class' => 'form-signin' ]); ?>
    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
    <img class="mb-4" src="/assets/img/logo-konektron-large.png" alt="" width="120" height="120">
    <h1 class="h3 mb-3 font-weight-normal">
        Redefinição de Senha
    </h1>
    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <label for="nova-senha" class="sr-only">
        Nova senha
    </label>
    <input type="text" id="nova-senha" name="newpassword" class="form-control" placeholder="Nova senha" required autofocus>
    <label for="confirmar-senha" class="sr-only">
        Confirmar senha
    </label>
    <input type="password" id="confirmar-senha" name="confirmpassword" class="form-control" placeholder="Confirmar Senha" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">
        Salvar
    </button>
    <p class="mt-5 mb-3 text-muted">&copy; Konektron 2020</p>
</form>
