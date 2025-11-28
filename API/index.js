import "dotenv/config";
import morgan from "morgan";
import express from "express";
import routes from "./routes/routes.js";

const api = express();
const apiPort = process.env.API_PORT;

api.use(morgan("dev"));

api.use(express.json());

api.use(routes);

api.listen(apiPort);