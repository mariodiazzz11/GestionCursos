# Contributing to Gestión de Cursos 🎓

¡Gracias por tu interés en contribuir al proyecto **Gestión de Cursos**! Este proyecto es una herramienta para la gestión de cursos en línea, donde los usuarios pueden inscribirse en cursos, y los administradores pueden gestionar y aceptar solicitudes de inscripción. A continuación, te ofrecemos una guía sobre cómo puedes contribuir. 🚀

## Cómo contribuir 💻

1. **Haz un fork de este repositorio** 🍴:
   - Haz clic en el botón **Fork** en la parte superior derecha de esta página para crear una copia del repositorio en tu cuenta.

2. **Clona el repositorio en tu máquina local** 🖥️:
   - Abre una terminal y ejecuta el siguiente comando:
     git clone https://github.com/tu-usuario/GestionCursos.git

3. **Crea una rama para tus cambios** 🌱:
   - Antes de empezar a trabajar en algo nuevo, asegúrate de crear una nueva rama para tu tarea o corrección de error.
     git checkout -b nombre-de-tu-rama

4. **Realiza tus cambios** ✨:
   - Haz los cambios que consideres necesarios en el proyecto. Si estás solucionando un error, asegúrate de que todo funcione correctamente antes de hacer un commit.

5. **Haz un commit de tus cambios** 📝:
   - Realiza un commit con un mensaje claro que explique el propósito de tus cambios. Por ejemplo:
     git commit -am "Agregada funcionalidad de inscripción automática"

6. **Sube tus cambios a GitHub** 📤:
   - Sube tus cambios a tu repositorio en GitHub:
     git push origin nombre-de-tu-rama

7. **Abre un pull request (PR)** 🔄:
   - Una vez que hayas subido tus cambios a tu repositorio, abre un **pull request** para que podamos revisar tus cambios y, si es necesario, fusionarlos con la rama principal (`main`).

## Requisitos para las contribuciones ✅

### Estructura del Proyecto
- El proyecto está desarrollado en **PHP** y usa **MySQL** para la gestión de datos. Asegúrate de que cualquier nueva funcionalidad sea compatible con estas tecnologías.
- Si realizas cambios en la base de datos (como agregar nuevas tablas o campos), asegúrate de actualizar el archivo SQL de la base de datos.

### Funcionalidades importantes 📚

1. **Gestión de cursos**:
   - El administrador puede agregar, borrar y desactivar cursos.
   - Asegúrate de que cualquier funcionalidad relacionada con los cursos tenga en cuenta el estado de inscripción de los mismos.

2. **Inscripción de usuarios**:
   - Los usuarios deben poder inscribirse en los cursos disponibles.
   - Si un curso tiene un plazo de inscripción que ha expirado, debe estar desactivado.

3. **Notificaciones por correo electrónico** 📧:
   - Si un usuario es aceptado en un curso, se enviará un correo de confirmación. Asegúrate de que los cambios en la lógica de inscripción incluyan la funcionalidad de correo.

4. **Panel de administrador** 🛠️:
   - El administrador debe tener acceso a un panel donde pueda gestionar los cursos y las solicitudes de los usuarios.

## Normas de estilo de código 🖋️

- Sigue las **convenciones de codificación de PHP**. Asegúrate de que tu código sea limpio y fácil de leer.
- Comenta el código donde sea necesario para explicar las partes más complejas o las decisiones de diseño.
- Usa **nombres de variables y funciones** descriptivos para facilitar la comprensión del código.

## Reportar problemas 🛑

Si encuentras errores o tienes ideas para mejorar el proyecto, abre un **issue** en el repositorio. Describe el problema o la sugerencia con claridad para que podamos abordarlo de manera eficiente.

## Código de conducta 🤝

Queremos que este proyecto sea un lugar inclusivo y amigable para todos. Por favor, sigue el **código de conducta** en el archivo `CODE_OF_CONDUCT.md`, el cual establece cómo debemos interactuar de manera respetuosa y profesional.

---

¡Gracias por contribuir a **Gestión de Cursos**! Tu ayuda es muy valiosa para mejorar este proyecto. 🎉
