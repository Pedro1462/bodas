CREATE TABLE `paquetes`(
    `id_eventos` INT NOT NULL,
    `id_usuarios` INT NULL,
    `id_servicio` INT NOT NULL,
    `nombre_paquete` VARCHAR(255) NOT NULL,
    `ruta_imagen` VARCHAR(255) NOT NULL,
    `id_paquete` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
CREATE TABLE `usuarios`(
    `nombre` VARCHAR(255) NOT NULL,
    `numero_telefono` VARCHAR(255) NOT NULL,
    `id_usuarios` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_tipo_user` INT NOT NULL,
    `correo` VARCHAR(255) NOT NULL,
    `apellido` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);
CREATE TABLE `eventos`(
    `id_eventos` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre_evento` VARCHAR(255) NOT NULL
);
CREATE TABLE `tipo_user`(
    `id_tipo_user` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tipo_user` VARCHAR(255) NOT NULL
);
CREATE TABLE `servicios`(
    `descripcion` VARCHAR(255) NOT NULL,
    `nombre_servicio` VARCHAR(255) NOT NULL,
    `precio_servicio` FLOAT(53) NOT NULL,
    `id_servicio` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
);
ALTER TABLE
    `usuarios` ADD CONSTRAINT `usuarios_id_tipo_user_foreign` FOREIGN KEY(`id_tipo_user`) REFERENCES `tipo_user`(`id_tipo_user`);
ALTER TABLE
    `paquetes` ADD CONSTRAINT `paquetes_id_eventos_foreign` FOREIGN KEY(`id_eventos`) REFERENCES `eventos`(`id_eventos`);
ALTER TABLE
    `paquetes` ADD CONSTRAINT `paquetes_id_usuarios_foreign` FOREIGN KEY(`id_usuarios`) REFERENCES `usuarios`(`id_usuarios`);
ALTER TABLE
    `paquetes` ADD CONSTRAINT `paquetes_id_servicio_foreign` FOREIGN KEY(`id_servicio`) REFERENCES `servicios`(`id_servicio`);