# RESTful API For a Blog

In the diagram i have explained the architecture of the blog.

The router will take the input, than it goes to the **bootstrap** class where we will load everything required by **DiC** 

![diagram](resources/git/diagram.png)

The bussines logic is constructed in the model area where the **Service** will comunicate with the **Mapper** via the **Entitiy/Data Object**.

We wil handle **Auth** in the service.

I tried to keep the the rule of **"Skiny Controllers and fat Models"**


### The project tree
```sh
 |-- config
 |   `-- Config.php
 |-- public
 |   |-- Config.php
 |   `-- index.php
 |-- resources
 |   |-- Logger
 |   |-- assets
 |   |   |-- icons
 |   |   `-- images
 |   `-- git
 |       `-- diagram.png
 `-- src
     `-- Tech387
         |-- Bootstrap
         |   `-- Bootstrap.php
         |-- Core
         |   |-- Component
         |   |   |-- DataMapper.php
         |   |   `-- MapperFactory.php
         |   |-- Exception
         |   |   |-- Controller.php
         |   |   |-- Database.php
         |   |   |-- Mapper.php
         |   |   `-- Service.php
         |   |-- Mapper
         |   |   `-- CanCreateMapper.php
         |   `-- OAuth2Server
         |       `-- OAuth2.php
         |-- Models
         |   |-- Entities
         |   |   |-- Admin.php
         |   |   |-- Auth.php
         |   |   |-- Blog.php
         |   |   `-- NewsLetter.php
         |   |-- Mappers
         |   |   |-- AdminMapper.php
         |   |   |-- AuthMapper.php
         |   |   |-- BlogMapper.php
         |   |   `-- NewsLetterMapper.php
         |   `-- Services
         |       |-- AdminService.php
         |       |-- AuthService.php
         |       |-- BlogService.php
         |       `-- NewsLetterService.php
         `-- Presentation
             |-- Controller
             |   |-- AdminController.php
             |   |-- AuthController.php
             |   |-- BlogController.php
             |   `-- NewsLetterController.php
             `-- Views
                 `-- JsonRenderer.php
```

The `/config` folder hold the global configuration of the project.




