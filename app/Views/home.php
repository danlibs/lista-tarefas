<?= $this->extend('master') ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" href="<?= base_url('css/estilos.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <img src="<?= base_url('img/tarefas.jpg') ?>" class="img-fluid">
            </div>
            <div class="col-sm-8" id="divQuadro">
                <h1>Tarefas do Dia</h1>
                <form>
                    <p>
                        <label for="inTarefa">Tarefa:</label>
                        <input type="text" name="inTarefa" id="inTarefa" class="form-control" required autofocus>
                    </p>
                    <p>
                        <input type="submit" class="btn btn-primary" value="Adicionar &#10003;">
                        <input type="button" class="btn btn-info" id="btnEditar" value="Editar Tarefa &#10000;">
                        <input type="button" class="btn btn-warning" id="btnRetirar" value="Retirar Selecionada &#10007;">
                        <input type="button" class="btn btn-danger" id="btnApagarTudo" value="Apagar Todas &#10008;">
                    </p>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="module" src="<?= base_url('js/lista.js') ?>"></script>
<?= $this->endSection() ?>