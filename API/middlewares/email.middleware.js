// API/services/email.service.js
import { Resend } from 'resend';
// ¡OJO! En ES Modules es obligatorio poner .js al final del archivo local
import { getVerificationTemplate } from '../utils/email_templates.js'; 

const resend = new Resend(process.env.RESEND_API_KEY);

export async function sendVerificationEmail(userEmail, userName, token) {
    
    const verificationLink = `${process.env.FRONTEND_URL}/verify?verification_token=${token}`;

    try {
        const data = await resend.emails.send({
            from: process.env.EMAIL_FROM, 
            to: [userEmail],
            subject: '🔐 Activa tu cuenta de Bonafide',
            html: getVerificationTemplate(userName, verificationLink),
        });

        return { success: true, id: data.data.id };
    } catch (error) {
        console.error('❌ Error enviando correo:', error);
        return { success: false, error };
    }
}