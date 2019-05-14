# sacaso

Descompactar o arquivo zip, onde dentro contém um .sql.

Importar ele para o banco de dados local.

Após isso vá até o arquivo model/Conexao.php, na linha 10, e edite as informações do banco de acordo com o seu.

O padrão como está é assim -> mysql:host=localhost;dbname=caixa_eletronico;", "root", "root"

Onde está "root", "root", quer dizer o "user, e a "senha" do banco de dados.

Caso não tenha senha, pode deixar a string vazia.
