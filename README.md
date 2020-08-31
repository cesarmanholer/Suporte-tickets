# Sistema de suporte por tickets

Este sistema utiliza as seguintes tecnologias:
- HTML 5
- CSS 3
- JavaScript
- PHP 7.2.29
- MariaDB 10.4.11

Este projeto foi criado com o intuito de colocar em pratica os conhecimentos adquiridos por cursos, caso queira utilizar em projeto final devera revisar o codigo aplicando
algumas correções de segurança que irei informar logo adiante.

Vale lembrar que a estrutura do site é simples, tendo muitos pontos a melhorar.

Ao longo da criação do projeto observei algumas falhas, não as corrigi pois o projeto é somente para testar meus conhecimentos, mas caso queira utilizar em algum projeto final tera que se atentar aos seguintes itens:

- Cross‑Site Scripting (XSS)
> Algumas paginas possui proteções, mas recomendo revisar tudo para que não haja nenhuma brecha.

- SQL Injection
> Não inseri proteções contra SQL injection, algumas proteçõs em PHP é a utilização do addslashes(), PDO, recomendo ver a [documentação](https://www.php.net/manual/pt_BR/security.database.sql-injection.php) para mais detalhes.

- Criptografia de senha
> Não inclui nenhuma medida de criptografia para as senha, caso utilize em algum projeto final tera que se atentar a esse ponto importante.

- Texto
> Como o intuito do projeto é ser simples mas funcional, não inclui quebras de linhas para quando o usuario as utiliza, portanto tudo sera retornado em uma unica linha, a edição dos textos tambem é simples utilizando somente um <textarea></textarea>, portanto recomendo o ajuste desses pontos caso utilize em projeto final.

- Registros de administradores
> Utilizei o mesmo sistema de registro de usuarios, portanto qualquer pessoa podera registrar uma conta de administrador.

- Responsividade
> Este projeto criei sem responsividade utilizando monitor de 1600 x 900, caso utilize em projeto final tera que personaliza-lo para diferentes telas.

## Configurações para utilizar em seu site

Os arquivos mais importantes são o con_db.php e o db_config.php.

- con_db.php
> Aqui devera modificar para que todo o sistema possa se comunicar com seu banco de dados.

- db_config.php
> Este arquivo é responsavel pela criação das tabelas necessarias para o funcionamento do site, devera realizar as configurações necessarias.

## Informações adicionais

Posso utilizar este projeto em meu site?
> Sim, desde que corrija as brechas de segurança e observe as normas da licença MIT.

Autor:
Cesar Augusto Manholer

Contato:

cesarmanholer@hotmail.com

[Instagram](https://www.instagram.com/cesar_manholer/)_&nbsp;_ _&nbsp;_ [Facebook](https://www.facebook.com/cesaraugusto.manholer/)_&nbsp;_ _&nbsp;_ [Linkedin](https://www.linkedin.com/in/cesar-augusto-manholer-2bb145183)
