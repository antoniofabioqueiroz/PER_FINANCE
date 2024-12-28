<main>
    <!-- Begin page content -->
    <br>
    <br>
    <br>
    <h1>Relatório de Despesas</h1>
   
    <!-- Formulário para gerar relatório com intervalo de datas e categoria -->
    <div class="input-group mb-3">    
        <form action="<?= base_url();?>report/generate_report" method="POST"> 
            <div class="d-flex justify-content-center"> 
                <label for="start_date">Data Inicial:</label> 
                <input class="form-control" type="date" id="start_date" name="start_date" required> 
                <label for="end_date">Data Final:</label> 
                <input class="form-control" type="date" id="end_date" name="end_date" required> 
                <label for="category_id">Categoria:</label> 
                <select class="form-select" aria-label="Default select example" name="category_id" required> 
                    <option value="">Selecione a Categoria</option> 
                        <?php foreach ($categories as $category): ?> 
                        <option value="<?= $category['id']; ?>">    
                        <?= htmlspecialchars($category['cat_nome']); ?>
                        </option> 
                        <?php endforeach; ?> 
                </select> 
                <br> 
                <button class="btn btn-success" type="submit">Gerar Relatório</button> 
            </div>    
        </form>
    </div>

    <hr>

    <h2>Despesas Registradas</h2>

    <?php if (empty($expenses)): ?>
        <p>Nenhuma despesa encontrada com os filtros fornecidos.</p>
    <?php else: ?>
        <table class="table" border="0">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expenses as $expense): ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($expense['data'])); ?></td>
                        <td><?= htmlspecialchars($expense['cat_nome']); ?></td>
                        <td><?= htmlspecialchars($expense['descricao']); ?></td>
                        <td>R$ <?= number_format($expense['valor'], 2, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>    
</main>