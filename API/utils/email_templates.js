export const getVerificationTemplate = (name, link) => {
    return `
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: 'Segoe UI', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
            .header { background-color: #D32F2F; padding: 40px 0; text-align: center; }
            .header h1 { color: #ffffff; margin: 0; font-size: 28px; font-weight: 700; letter-spacing: 2px; }
            .content { padding: 40px 30px; color: #444444; line-height: 1.6; }
            .btn-container { text-align: center; margin: 35px 0; }
            .button { display: inline-block; background-color: #D32F2F; color: #ffffff; padding: 14px 28px; text-decoration: none; border-radius: 50px; font-weight: bold; }
            .footer { background-color: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #999999; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>BONAFIDE</h1>
            </div>
            <div class="content">
                <h2 style="color: #333;">¡Hola, ${name}! 👋</h2>
                <p>Gracias por unirte. Necesitamos verificar que este correo te pertenece.</p>
                <div class="btn-container">
                    <a href="${link}" class="button">Verificar mi Cuenta</a>
                </div>
            </div>
            <div class="footer">
                &copy; ${new Date().getFullYear()} Bonafide Gestión.
            </div>
        </div>
    </body>
    </html>
    `;
};