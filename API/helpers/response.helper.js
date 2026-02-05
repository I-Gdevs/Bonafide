export const success = (req, res, statusCode = 200, data, message = "Operación exitosa") => {
    
    let responseBody = {
        success: true,
        message: message,
        data: data,
    };

    if (Array.isArray(data)) {
        responseBody.count = data.length;
    }

    return res.status(statusCode).json(responseBody);
}

export const error = (req, res, errorRaw) => {

    let statusCode = errorRaw.statusCode || 500;
    
    let message = errorRaw.message || errorRaw || "Error desconocido del servidor";

    return res.status(statusCode).json({
        success: false,
        error: message
    });

}