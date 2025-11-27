import { Router } from "express";

import userRouter from "./user.route.js";
import providerRouter from "./provider.route.js";

const router = Router();

router.use("/user", userRouter);
router.use("/provider", providerRouter);

export default router;