<a name="readme-top"></a>
<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/pauloaraujo028/bibliovelteca-laravel-vue">
    <h1 align="center">Digital Book</h1>
  </a>

  <h4 align="center">  
    <br />
    <a href="https://github.com/pauloaraujo028/bibliovelteca-laravel-vue/issues/new" target="_blank">Relatar Bug</a>
    ·
    <a href="https://github.com/pauloaraujo028/bibliovelteca-laravel-vue/issues/new" target="_blank">Recurso de Issues</a>
  </h4>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Índice</summary>
  <ol>
    <li>
      <a href="#about-the-project">Sobre o Projeto</a>
      <ul>
        <li><a href="#function">Funcionalidades principais</a></li>
        <li><a href="#built-with">Construído com</a></li>
      </ul> 
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#installation">Instalação</a></li>
      </ul>
    </li>
    <li><a href="#contributing">Contribuindo</a></li>
    <li><a href="#license">Licença</a></li>
    <li><a href="#contact">Contato</a></li>
    <!-- <li><a href="#acknowledgments">Agradecimentos</a></li> -->
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
<a name="about-the-project"></a>
## Sobre o Projeto

Projeto Biblioteca - CRUD

<img width="1493" alt="Login e Register Page" src="https://github.com/pauloaraujo028/bibliovelteca-laravel-vue/assets/105018299/1bdb8c12-276d-497b-87d7-20907559f27f">
<img width="1493" alt="Login e Register Page" src="https://github.com/pauloaraujo028/bibliovelteca-laravel-vue/assets/105018299/2344bad5-656d-45ce-82ad-6144936022fd">
<img width="1493" alt="Página de Perfil" src="https://github.com/pauloaraujo028/bibliovelteca-laravel-vue/assets/105018299/bfa48439-5551-4066-b029-de1d22287fac">

<a name="function"></a>
**Funcionalidades principais:**

* Página de Cadastro e Login.
* Sistema de validações.
* Painel do Usuário.
* Cadastro de Usuários/Livros.
* Sistema de Aluguel de livros.

**Resumo:**

O projeto é uma aplicação para gerenciar aluguéis de livros em uma biblioteca. Ele oferece diversas funcionalidades para facilitar o processo de empréstimo e devolução de livros, além de manter um registro organizado das transações.

**Funcionalidades:**

Cadastro de Livros:
Permite adicionar novos livros ao catálogo da biblioteca.

Cadastro de Usuários:
Permite registrar novos usuários, incluindo nome e CPF, garantindo que cada CPF seja único.

Aluguel de Livros:
Possibilita o empréstimo de livros para usuários cadastrados, com validações de disponibilidade e datas válidas.

Devolução de Livros:
Permite que os usuários devolvam os livros alugados.

**Tecnologias Utilizadas:**

* Laravel: Backend do projeto, um framework PHP robusto e muito utilizado, que oferece ferramentas poderosas para desenvolver aplicações web.

* Vue.js: Frontend do projeto, um framework progressivo de JavaScript que facilita a criação de interfaces interativas.

* MySQL: Banco de dados utilizado para armazenar informações sobre livros, usuários e transações de aluguel.

* Inertia.js: Permite construir aplicativos full-stack sem a necessidade de API RESTful.

* Tailwind CSS: Framework de CSS que agiliza o desenvolvimento, proporcionando um estilo visual moderno e responsivo.

**Relatórios de Aluguéis:**

Disponibiliza a exportação de uma lista de aluguéis, contendo informações sobre o usuário, livro, datas de empréstimo e devolução.

**Outras Observações:**

O projeto implementa validações importantes, como a restrição de um único usuário por CPF, a verificação de datas válidas para aluguéis e a disponibilidade do livro na data desejada. Além disso, há funcionalidades extras, como a exportação de relatórios em formato .txt.

O código está estruturado de forma organizada, com controllers, models e rotas bem definidas, facilitando a manutenção e expansão da aplicação. Também foram implementados testes para garantir a confiabilidade do sistema.

**Próximas atualizações:**

* Melhorar layout para mobile.
* Finalizar exportação de informções.
* Melhorar design visual de todo o projeto.
* Refatorar o Projeto para melhorar manutenção.


<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>

<a name="built-with"></a>
## Construído com

**Principais tecnologias:**

* ![Vue.js](https://img.shields.io/badge/vuejs-%2335495e.svg?style=for-the-badge&logo=vuedotjs&logoColor=%234FC08D)
* ![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
* ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
* ![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)
* ![Vite](https://img.shields.io/badge/vite-%23646CFF.svg?style=for-the-badge&logo=vite&logoColor=white)
* ![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)

<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>


<!-- GETTING STARTED -->
<a name="getting-started"></a>
## Getting Started

<a name="installation"></a>
### Instalação

1. Baixe/Instale o XAMPP ou WAMPP.

2. Abra o painel de controle do XAMPP e inicie [apache] e [mysql].

3. Baixe o projeto do Github (https://github.com/pauloaraujo028/bibliovelteca-laravel-vue) ou siga os comandos do Gitbash

        >cd C:\xampp\htdocs\

        >git clone https://github.com/pauloaraujo028/crud-app.git

4. Extraia os arquivos em C:\xampp\htdocs.

5. Abra o link localhost/phpmyadmin.

6. Clique em novo na barra lateral.

7. Dê um nome de banco de dados como (dblaravel) e clique no botão criar.
* Obs: Se optar por outro nome de banco de dados precisa alterar o arquivo .env na raiz do projeto (DB_DATABASE=nomedoseubanco)

9. Após criar o nome do banco de dados, clique em importar.

10. Procure o arquivo no diretório [db\dblaravel.sql].

11. Após importar com sucesso.

12. Abra um terminal de digite

        >php artisan serve

13. Em um novo terminal digite

        >npm i
        >npm run dev

15. Abra qualquer navegador e digite http://localhost:8000/.

<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>

<!-- CONTRIBUTING -->
<a name="contributing"></a>
## Contribuição

As contribuições são o que tornam a comunidade de código aberto um lugar incrível para aprender, inspirar e criar. Quaisquer contribuições que você fizer são **muito apreciadas**.

Se você tiver uma sugestão para melhorar o projeto, faça um fork do repositório e crie uma solicitação pull. Você também pode simplesmente abrir um issue com a tag "melhoria".
Não se esqueça de dar uma estrela ao projeto! Obrigado novamente!

1. Faça o Fork do Projeto
2. Crie seu Branch (`git checkout -b feature/RecursoIncrivel`)
3. Commit suas alterações (`git commit -m 'Adicione algum recurso incrivel'`)
4. Push para o Branch (`git push origin feature/RecursoIncrivel`)
5. Abra um Pull Request

<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>

<!-- LICENSE -->
<a name="license"></a>
## Licença

Distribuído sob a licença MIT.

<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>

<!-- CONTACT -->
<a name="contact"></a>
## Contato
### Paulo Araújo

[![Portfolio](https://img.shields.io/badge/Portfolio-%23000000.svg?style=for-the-badge&logo=firefox&logoColor=#FF7139)](https://pauloaraujo-portfolio.netlify.app/)
[![LinkedIn](https://img.shields.io/badge/linkedin-%230077B5.svg?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/pauloaraujo028/)
[![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white)](https://github.com/pauloaraujo028) 
[![Gmail](https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white)](mailto:pauloaraujo.phz@gmail.com)

<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>


<!-- ACKNOWLEDGMENTS 
<a name="acknowledgments"></a>
## Agradecimentos

* 
* 
* 
* 
<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>-->
