import { body, validationResult } from "express-validator";

export const validateCreateUser = [
    body("user_name")
    .trim()
    .notEmpty().withMessage("El nombre es un campo obligatorio.")
    .isLength({ min: 3 }).withMessage("El nombre ha de tener al menos 3 letras.")
    .escape(),

    body("user_email")
    .trim()
    .notEmpty().withMessage("El correo electrónico es un campo obligatorio.")
    .isEmail().withMessage("No es un correo electrónico válido.")
    .normalizeEmail(),

    body("user_dni")
    .trim()
    .notEmpty().withMessage("El DNI es un campo obligatorio.")
    .isNumeric().withMessage("El DNI solo puede contener números.")
    .isLength({ min: 6, max: 11}).withMessage("El DNI debe tener un largo válido."),

    body("user_password")
    .notEmpty().withMessage("La contraseña es un campo obligatorio.")
    .isLength({ min: 8 }).withMessage("La contraseña debe tener al menos 8 caracteres."),

    body("user_role")
    .optional()
    .isNumeric()
    .escape(),

    (req, res, next) => {
        const errors = validationResult(req);

        if (!errors.isEmpty()) {
            return res.status(400).json({
                error: "Error en la validación de los datos del usuario.",
                error_details: errors.array()
            });
        }
        
        next();
    }
];

export const validateLoginuser = [
    body('user_email')
    .trim()
    .notEmpty().withMessage("El correo electrónico es un campo obligatorio.")
    .isEmail().withMessage("No es un correo electrónico valido.")
    .normalizeEmail(),

    body("user_password")
    .notEmpty().withMessage("La contraseña es un campo obligatorio."),

    (req, res, next) => {
        const errors = validationResult(req);

        if (!errors.isEmpty()) {
            return res.status(400).json({
                error: "Error en la validación de los datos del usuario.",
                error_details: errors.array()
            });
        }

        next();
    }

];