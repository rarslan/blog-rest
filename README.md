# RESTful API For blog

In the diagram i have explained the architecture of the blog.

The router will take the input, than it goes to the **bootstrap** class where we will load everything required by **DiC** 

![diagram](resources/git/diagram.png)

The bussines logic is constructed in the model area where the **Service** will comunicate with the **Mapper** via the **Entitiy/Data Object**.

We wil handle **Auth** in the service.

I tried to keep the the rule of **"Skiny Controllers and fat Models"**

The `/config` folder hold the global configuration of the project.


