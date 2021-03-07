<div class="container-fluid">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center">Registro de novo cliente</h3>

            <form action="?a=createCostumer" method="post">
                <!-- Email -->
                <div class="my-3">
                    <label>Email</label>
                    <input type="email" name="email" id="" placeholder="Email" class="form-control" require>
                </div>

                <!-- Password 1 -->
                <div class="my-3">
                    <label>Senha</label>
                    <input type="password" name="password_1" id="" placeholder="Senha" class="form-control" require>
                </div>
                <!-- Password 2 -->
                <div class="my-3">
                    <label>Confirmar senha</label>
                    <input type="password" name="password_2" id="" placeholder="confirmar senha" class="form-control" require>
                </div>

                <!-- Nome Completo -->
                <div class="my-3">
                    <label>Nome Completo</label>
                    <input type="text" name="full_name" id="" placeholder="Nome completo" class="form-control" require>
                </div>

                <!-- address -->
                <div class="my-3">
                    <label>Endereço</label>
                    <input type="text" name="address" id="" placeholder="Endereço" class="form-control" require>
                </div>

                <!-- Cidade -->
                <div class="my-3">
                    <label>Cidade</label>
                    <input type="text" name="city" id="" placeholder="Cidade" class="form-control" require>
                </div>

                <!-- Telefone -->
                <div class="my-3">
                    <label>Telefone</label>
                    <input type="text" name="phone" id="" placeholder="(99) 99999-9999" class="form-control">
                </div>


                <!-- Submit -->
                <div class="my-4">
                    <input type="submit" value="Criar conta" class="btn btn-primary">
                </div>

                <!-- Apresenta os erros do formulario -->
                <?php if (isset($_SESSION['erro'])) : ?>
                    <div class="alert alert-danger text-center p-2">
                        <?= $_SESSION['erro'] ?>
                        <?php unset($_SESSION['erro']) ?>
                    </div>
                <?php endif; ?>


            </form>
        </div>
    </div>
</div>

<!-- 
    email *
    password_1 *
    password_2 *
    full_name *
    address *
    city *
    phone 
 -->