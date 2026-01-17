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

export const error = (req, res, statusCode = 500, message) => {
    
    return res.status(statusCode).json({
        success: false,
        message: "Ocurrió un error",
        error: message
    });
    
}