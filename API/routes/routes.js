import { Router } from "express";

import userRouter from "./user.route.js";
import providerRouter from "./provider.route.js";
import buildingRouter from "./building.route.js";

const router = Router();

router.use("/user", userRouter);
router.use("/provider", providerRouter);
router.use("/building", buildingRouter);

export default router;