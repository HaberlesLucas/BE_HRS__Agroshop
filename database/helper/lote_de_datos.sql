INSERT INTO productos (codigo, nombre, descripcion, stock, stock_min, precio_compra, incremento, id_categoria) VALUES
-- Alimentos para Animales (ID Categoría: 1)
('AA001', 'Alimento para Perros', 'Alimento balanceado para perros adultos.', 100, 20, 50.00, 20.00, 1),
('AA002', 'Alimento para Gatos', 'Alimento premium para gatos de todas las edades.', 80, 15, 60.00, 15.00, 1),

-- Semillas (ID Categoría: 2)
('SE001', 'Semillas de Maíz', 'Semillas certificadas de maíz híbrido.', 200, 50, 25.00, 10.00, 2),
('SE002', 'Semillas de Girasol', 'Semillas de alta calidad para cultivo de girasol.', 150, 30, 30.00, 12.00, 2),

-- Fertilizantes y Abonos (ID Categoría: 3)
('FA001', 'Fertilizante Nitrogenado', 'Fertilizante ideal para cultivos de cereal.', 120, 20, 40.00, 18.00, 3),
('FA002', 'Abono Orgánico', 'Abono natural para huertos y jardines.', 180, NULL, 20.00, 8.00, 3),

-- Productos para Control de Plagas (ID Categoría: 4)
('PCP001', 'Insecticida para Cultivos', 'Insecticida eficaz contra plagas comunes en cultivos.', 90, 10, 50.00, 25.00, 4),
('PCP002', 'Raticida', 'Producto efectivo para control de roedores.', 70, NULL, 15.00, 5.00, 4),

-- Herramientas y Equipos de Campo (ID Categoría: 5)
('HEC001', 'Pala de Acero', 'Pala reforzada para trabajos agrícolas.', 60, 10, 30.00, 12.00, 5),
('HEC002', 'Azadón Multiusos', 'Herramienta ideal para preparación de terrenos.', 50, NULL, 25.00, 10.00, 5),

-- Medicamentos Veterinarios (ID Categoría: 6)
('MV001', 'Antibiótico Bovino', 'Medicamento para tratar infecciones en bovinos.', 30, 5, 80.00, 30.00, 6),
('MV002', 'Vitaminas para Equinos', 'Suplemento vitamínico para caballos.', 40, 10, 60.00, 20.00, 6),

-- Equipos y Accesorios para Animales (ID Categoría: 7)
('EAA001', 'Correa para Perros', 'Correa ajustable para perros medianos.', 100, NULL, 15.00, 7.00, 7),
('EAA002', 'Comedero Automático', 'Comedero con capacidad de 3 kg de alimento.', 50, 10, 50.00, 20.00, 7),

-- Materiales para Construcción Rural (ID Categoría: 8)
('MCR001', 'Malla para Gallinero', 'Malla resistente para construcción de gallineros.', 25, 5, 100.00, 40.00, 8),
('MCR002', 'Cemento Resistente', 'Cemento especial para construcción rural.', 40, 10, 120.00, 45.00, 8),

-- Productos Agroindustriales (ID Categoría: 9)
('PA001', 'Aceite de Soya', 'Aceite vegetal de alta calidad para consumo humano.', 300, 50, 10.00, 4.00, 9),
('PA002', 'Harina de Trigo', 'Harina enriquecida para panificación.', 250, 40, 12.00, 5.00, 9),

-- Ropa y Calzado de Trabajo (ID Categoría: 10)
('RCT001', 'Botas de Trabajo', 'Botas de seguridad para trabajos en campo.', 80, 20, 75.00, 25.00, 10),
('RCT002', 'Chaqueta Reflectante', 'Chaqueta de alta visibilidad para trabajo nocturno.', 100, 15, 50.00, 20.00, 10);
