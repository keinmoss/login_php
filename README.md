Sistema de Login en PHP y MySQL

Este es un pequeño proyecto hecho para la actividad B1.  
Consiste en un sistema básico de autenticación donde un usuario puede:

- Registrarse
- Iniciar sesión
- Acceder a una página protegida solo si tiene sesión activa
- Cerrar sesión

¿Qué utilicé?

- PHP
- MySQL (MariaDB)
- XAMPP
- phpMyAdmin
- HTML y un poco de CSS para mejorar el diseño

¿Qué hace el sistema?

1. **Registro de usuarios:**  
   Guarda el nombre, correo y contraseña del usuario.  
   La contraseña no se guarda directamente, sino en formato hash usando password_hash().

2. **Login:**  
   Verifica el correo y la contraseña con password_verify().

3. **Sesiones:**  
   Utilizo session_start() para manejar la sesión del usuario  
   y permitir acceso solo a quienes hayan iniciado sesión.

4. **Página protegida:**  
   Solo se puede entrar si existe una sesión activa.  
   Si no, se redirige al login automáticamente.

5. **Cerrar sesión:**  
   Destruye la sesión y regresa al login.

Base de datos

Nombre: **login_php**

Tabla: **usuarios**

Columnas:
- id (int, autoincrement, PK)
- nombre (varchar)
- correo (varchar)
- password (varchar, hash)

Notas

El proyecto fue hecho con fines de aprendizaje y cumple con los requisitos de la actividad.  
Se puede mejorar el diseño o agregar nuevas funciones más adelante.

---

