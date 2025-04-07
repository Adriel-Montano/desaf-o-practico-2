# Sistema de Gestión de Proyectos Colaborativos

## Desafío Práctico 2 - Desarrollo de Aplicaciones Web con Software Interpretado en el Servidor

**Estudiantes:** Adriel Caleb Montano Lemus 
**Grupo:** 06L  
**Ciclo:** 01-2025  
**Docente:** Ing. Yesenia Escobar

---

### Descripción del Proyecto

Este proyecto es un sistema web desarrollado en PHP y MySQL que permite a los empleados de una pequeña empresa registrarse, iniciar sesión, crear y administrar proyectos colaborativos, subir y eliminar documentos (PDF o imágenes) asociados a los proyectos, y cerrar sesión. El sistema cumple con los principios de POO, autenticación con sesiones, gestión de archivos, y uso de una base de datos relacional.

---

### Instrucciones de Instalación y Uso

1. **Configurar WampServer**:
   - Asegúrate de que WampServer esté instalado y que los servicios de Apache y MySQL estén corriendo.
   - Coloca la carpeta `proyectos_colaborativos/` en el directorio raíz de WampServer `C:/wamp64/www/`.

2. **Crear la Base de Datos**:
   - Abre phpMyAdmin .
   - Ejecuta el script `database.sql` para crear la base de datos y las tablas necesarias.

3. **Configurar Permisos**:
   - Asegúrate de que la carpeta `uploads/` tenga permisos de escritura. En Windows, haz clic derecho en la carpeta, ve a "Propiedades", pestaña "Seguridad", y dale permisos completos a "Todos".

4. **Acceder al Sistema**:
   - Abre tu navegador y accede a `http://localhost/proyectos_colaborativos/index.php`.
   - Regístrate con un nuevo usuario, inicia sesión, y comienza a usar el sistema.

---

### Estructura de Clases

- **Database.php**:
  - Maneja la conexión a la base de datos MySQL.
  - Propiedades privadas: `$host`, `$user`, `$pass`, `$dbname`, `$conn`.
  - Métodos: `getConnection()`, `__destruct()`.

- **User.php**:
  - Gestiona el registro, login y autenticación de usuarios.
  - Propiedades privadas: `$db`, `$id`, `$username`, `$email`.
  - Métodos: `register()`, `login()`, `isLoggedIn()`, `getUserId()`.

- **Project.php**:
  - Administra el CRUD de proyectos.
  - Propiedades privadas: `$db`.
  - Métodos: `create()`, `getProjects()`, `getProject()`, `update()`, `delete()`.

- **File.php**:
  - Maneja la subida y eliminación de archivos.
  - Propiedades privadas: `$db`.
  - Métodos: `upload()`, `delete()`, `getFiles()`.

---

### Roles Asumidos

- **Desarrolladores Principal:** Adriel Caleb Montano Lemus
  - Responsable de la implementación completa del sistema
  -  diseño de la base de datos,
  -   desarrollo de las clases,
  -    interfaz de usuario 
  -    documentación.

---

### Notas Adicionales

- El proyecto incluye un archivo `styles.css` para estilizar la interfaz.
- Los archivos subidos se almacenan en la carpeta `uploads/` y se registran en la base de datos.
- El sistema valida que los archivos subidos sean PDF o imágenes (jpg, jpeg, png) y tengan un tamaño máximo de 5MB.
