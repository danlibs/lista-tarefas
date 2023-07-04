<?= $this->extend('master') ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <div class="mb-4 pb-2 border-bottom border-primary">
                        <h1>Lista de Tarefas - Cadastro</h1>
                    </div>
                    <div class="mx-auto p-2 border rounded-2 border-primary">
                        <form method="POST" action="<?= url_to('usuario.save') ?>">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" name="nome" class="form-control border-primary" autofocus required>
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="text" name="email" class="form-control border-primary" autofocus required>
                            <label for="senha" class="form-label">Senha:</label>
                            <input type="password" name="senha" class="form-control border-primary" required> <br> 
                            <input type="submit" class="btn btn-primary" value="Salvar"> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<?= $this->endSection() ?>