import "dotenv/config";
import morgan from "morgan";
import express from "express";
import routes from "./routes/routes.js";

const api = express();
const apiPort = process.env.API_PORT;

if (process.env.NODE_ENV === 'development') {
    api.use(morgan('combined'));
} else {
    api.use(morgan('combined'));
}
api.use(express.json());

api.use(routes);

api.listen(apiPort);