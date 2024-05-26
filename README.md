> [!IMPORTANT]
> PROYECTO CANCELADO <br>
> PROJECT CANCELLED

# Proyecto_IngSoftware
Proyecto Ingeniería de Software


> [!IMPORTANT]
> Para que funcione la api
> Se debe de configurar

## XAMPP

   - 📂xampp<br>
     &emsp;⨽ 📂apache<br>
     &emsp;&emsp;⨽ 📂conf<br>
     &emsp;&emsp;&emsp;⨽ 📂extra<br>
     &emsp;&emsp;&emsp;&emsp;⨽ 📄httpd-vhosts

En el archivo de 📄httpd-vhosts poner lo siguiente
> [!NOTE]
> Lo que esta entre comillas en **_DocumentRoot_** es la ruta donde están guardadas las carpetas correspondientes<br>
> { 📁apirest-dinamica-paleteria }
```
<VirtualHost *:80>
    ServerName apicopacabana.com
    DocumentRoot "C:/xampp/htdocs/apirest-dinamica-paleteria"
</VirtualHost>

```

## Windows
   - 📂windows<br>
     &emsp;⨽ 📂System32<br>
     &emsp;&emsp;⨽ 📂drivers<br>
     &emsp;&emsp;&emsp;⨽ 📂etc<br>
     &emsp;&emsp;&emsp;&emsp;⨽ 📄hosts

En el archivo de 📄hosts poner lo siguiente
```
127.0.0.1	   apicopacabana.com
```
> [!NOTE]
> A la hora de clonar el proyecto de GitHub al repositorio local
> Hacer lo siguiente:

* Ir a la carpeta donde esta el proyecto clonado
* cd /carpetas-proyecto-paleteria
* poner el comando **npm install**

> [!IMPORTANT]
> Para iniciar cada proyecto <br>
> Estar dentro de la carpeta "carpetas-proyecto-paleteria" <br>
> Para abrir el proyecto "paleteria_administracion" poner el comando: `ng serve paleteria_administracion` <br>
> Para abrir el proyecto "paleteria_cliente" poner el comando: `ng serve paleteria_cliente`

> [!IMPORTANT]
> Para crear un componente en cada proyecto <br>
> Estar dentro de la carpeta "carpetas-proyecto-paleteria" <br>
> Para crear un componente en el proyecto "paleteria_administracion" poner el comando: <br>`ng g c [nombre del componente] --project="paleteria_administracion"` <br>
> Para crear un componente en el proyecto "paleteria_cliente" poner el comando: <br>`ng g c [nombre del componente] --project="paleteria_cliente"`

> [!NOTE]
> En el proyecto ***paleteria_administracion*** hay un componente llamado *temporal* en donde hay código documentado para traer datos de la api ("GET") 
