import jwt from "jsonwebtoken";

export const verifyToken = (req, res, next) => {
    let authHeader = req.headers.authorization;

    if (!authHeader) {
        return res.status(401).json({
            error: "Acceso denegado. Token no proporcionado."
        });
    }

    let authHeaderSplitted = authHeader.split(" ");

    let token = null;
    if (authHeaderSplitted.length === 2 && authHeaderSplitted[0] === "Bearer") {
        token = authHeaderSplitted[1];
    }
    
    if (!token) {
        return res.status(401).json({
            error_message: "Formato de token inválido."
        });
    }

    try {
        let decodedToken = jwt.verify(token, process.env.JWT_SECRET);

        req.user = decodedToken;
        
        next();
    } catch (error) {
        return res.status(403).json({
            error_message: "Token inválido o expirado."
        });
    }
}