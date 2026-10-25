# Práctica 7: aplicación web con Docker Compose

Aplicación “Hola Mundo” desarrollada con PHP 8.3 y Apache. La aplicación consulta un mensaje almacenado en MySQL 8.4 para comprobar que ambos servicios se comunican correctamente.

## Requisitos

- Docker Desktop o Docker Engine con Docker Compose.
- Git, únicamente para publicar el proyecto.

## Estructura

```text
.
├── database/
│   └── init.sql
├── src/
│   ├── Database.php
│   └── index.php
├── .env.example
├── Dockerfile
└── docker-compose.yml
```

## Ejecutar la aplicación

1. Opcionalmente, copia `.env.example` como `.env` para personalizar las credenciales y el puerto.
2. Construye e inicia los contenedores:

   ```bash
   docker compose up --build -d
   ```

3. Abre <http://localhost:8080> en el navegador.
4. Comprueba el estado de los servicios:

   ```bash
   docker compose ps
   ```

5. Para detener la aplicación:

   ```bash
   docker compose down
   ```

Para detenerla y borrar también los datos persistentes de MySQL, usa `docker compose down -v`.

Si el puerto `8080` ya está ocupado, crea el archivo `.env` y cambia `APP_PORT` por otro puerto disponible, por ejemplo `APP_PORT=8081`. Luego abre <http://localhost:8081>.

## Publicar en GitHub

Crea primero un repositorio vacío en GitHub. Después, desde este directorio, ejecuta:

```bash
git init
git add .
git commit -m "Agregar practica 7 con Docker Compose"
git branch -M main
git remote add origin https://github.com/TU_USUARIO/practica-7.git
git push -u origin main
```

Finalmente, entrega la URL del repositorio, por ejemplo: `https://github.com/TU_USUARIO/practica-7`.
