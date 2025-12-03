<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defensa de Tesis - Bonafide</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* Estructura básica de la página */
        body {
            background-color: #f8f0f0; /* Fondo claro para contraste */
            color: #343a40;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            }
        
        body::-webkit-scrollbar {
            display: none; /* Oculta la barra pero permite el desplazamiento con el mouse o teclado */
        }
        
        /* Contenedor principal para centrar el contenido */
        .presentation-stage {
            max-width: 1320px;
            width: 90%;
            height: 800px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Contenedor del Logo (Cuadrado) */
        .logo-container {
            width: 150px;
            height: 150px;
            overflow: hidden;
            flex-shrink: 0; /* Evita que el logo se encoja */
            transition: all 1s ease-in-out;
        }
        .logo-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Contenedor del Texto (Efecto máquina de escribir) */
        .text-container {
            margin-left: 20px;
            min-width: 400px; /* Ancho fijo para evitar saltos de línea */
            position: relative;
        }
        .text-line {
            font-family: 'Poppins', sans-serif; /* Fuente de máquina de escribir */
            font-size: 3rem;
            font-weight: 900;
            color: #020202ff; /* Color rojo de Bonafide */
            white-space: nowrap; /* Evita saltos de línea */
            overflow: hidden;
            letter-spacing: .05em;
            width: 0; /* Inicialmente ancho cero para el efecto de escritura */
            display: inline-block;
        }
        
        /* Estilos específicos para el paso 6 */
        .integrantes-container {
            position: absolute;
            top: 100%;
            left: 0;
            display: flex;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            margin-top: 20px;
        }
        .integrante {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 30px;
            font-size: 1rem;
            font-weight: 600;
            color: #343a40;
        }
        .integrante img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e53935;
            margin-bottom: 5px;
        }

    </style>
</head>
<body>

    <div class="presentation-stage">
        
        <div id="logoContainer" class="logo-container">
            <img id="logoImg" src="./../../img/logo/LogoRedondo.png" alt="Logo Bonafide" class="logo-img logo-giratorio">
        </div>
        
        <div class="text-container">
            <span id="typingText" class="text-line"></span>
            
            <div id="integrantes" class="integrantes-container">
                <div class="integrante">
                    <img src="./../../img/logo/LogoRedondo.png" alt="Guido Asplanatti">
                    Guido Asplanatti
                </div>
                <div class="integrante">
                    <img src="./../../img/logo/LogoRedondo.png" alt="Ignacio Imas">
                    Ignacio Imas
                </div>
            </div>
        </div>

    </div>

    <script>
        // --- Configuración ---
        const logoImg = document.getElementById('logoImg');
        const logoContainer = document.getElementById('logoContainer');
        const typingTextElement = document.getElementById('typingText');
        const integrantesContainer = document.getElementById('integrantes');
        
        // El array de la secuencia de texto y acciones
        const sequence = [
            { text: "Bonafide", delay: 1500, clear: true }, // Paso 1, 2, 3
            { text: "Web", delay: 1500, clear: true },      // Paso 4
            { text: "Bonafide Web", delay: 3000, clear: false, action: 'show_integrantes' } // Paso 6
        ];
        
        // --- Funciones de Animación ---

        function typeWriter(text, speed = 75) {
            return new Promise(resolve => {
                let i = 0;
                typingTextElement.style.width = 'auto'; // Reset width for typing effect
                
                function type() {
                    if (i < text.length) {
                        typingTextElement.textContent += text.charAt(i);
                        i++;
                        setTimeout(type, speed);
                    } else {
                        resolve();
                    }
                }
                type();
            });
        }

        function eraseText(speed = 40) {
            return new Promise(resolve => {
                let text = typingTextElement.textContent;
                
                function erase() {
                    if (text.length > 0) {
                        text = text.slice(0, -1);
                        typingTextElement.textContent = text;
                        setTimeout(erase, speed);
                    } else {
                        resolve();
                    }
                }
                setTimeout(erase, 500); // Espera medio segundo antes de borrar
            });
        }

        async function step5CenterLogo() {
            // ⭐ Paso 5: Centra el logo y la animación de 'Web' está a la derecha del logo
            return new Promise(resolve => {
                logoContainer.style.marginRight = '0';
                setTimeout(resolve, 500);
            });
        }

        async function startSequence() {
            let initialDelay = 1500; // Espera al inicio
            
            // ⭐ Paso 1 - 4: Ejecuta la secuencia de escritura y borrado
            for (const item of sequence) {
                typingTextElement.textContent = ''; // Limpia antes de empezar a escribir
                
                await new Promise(r => setTimeout(r, 500)); // Pequeña pausa entre borrado y escritura
                
                // 1. Escribir el texto
                await typeWriter(item.text);
                
                // 2. Ejecutar acción de centrado (Paso 5 - después de 'Web')
                if (item.text === "Web") {
                    await step5CenterLogo();
                }
                
                // 3. Esperar el delay (5 segundos en el primer caso)
                await new Promise(r => setTimeout(r, item.delay));
                
                // 4. Borrar (si el flag clear es true)
                if (item.clear) {
                    await eraseText();
                }
                
                // 5. Mostrar integrantes (Paso 6)
                if (item.action === 'show_integrantes') {
                    integrantesContainer.style.opacity = '1';
                    await new Promise(r => setTimeout(r, 4000)); // Muestra por 4 segundos
                }
            }
            
            // ⭐ Paso 6/7: Borra todo y vuelve al inicio
            integrantesContainer.style.opacity = '0';
            await eraseText();
            
            // Espera final antes de reiniciar
            await new Promise(r => setTimeout(r, 1000)); 
            
            // Reinicia la secuencia
            startSequence(); 
        }

        // --- Inicio de la Aplicación ---
        startSequence();

    </script>
</body>
</html>