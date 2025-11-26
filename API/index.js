import "dotenv/config";
import express from "express";
import routes from "./routes/routes.js";

const api = express();
const apiPort = process.env.API_PORT;

api.use(express.json());
api.use(routes);

api.listen(apiPort);