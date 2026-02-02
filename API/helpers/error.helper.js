export class AppError extends Error {
    constructor(message, statusCode) {
        super(message);
        this.statusCode = statusCode;
        this.status = `${statusCode}`.startsWith("4") ? "fail" : "error";
        this.isOperational = true;
        Error.captureStackTrace(this, this.constructor);
    }
}

export class NotFoundError extends AppError {
    constructor(message = "Recurso no encontrado") {
        super(message, 404);
    }
}

export class BadRequestError extends AppError {
    constructor(message = "Datos inválidos") {
        super(message, 400);
    }
}

export class UnauthorizedError extends AppError {
    constructor(message = "No autorizado") {
        super(message, 401);
    }
}

export class ConflictError extends AppError {
    constructor(message = "Conflicto en la operación") {
        super(message, 409);
    }
}

export const errorHandler = {
    notFound: (msg) => { throw new NotFoundError(msg); },
    badRequest: (msg) => { throw new BadRequestError(msg); },
    unathorized: (msg) => { throw new UnauthorizedError(msg); },
    conflict: (msg) => { throw new ConflictError(msg); },
    custom: (msg, code) => { throw new AppError(msg, code); }
};