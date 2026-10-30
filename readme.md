# API RESTful - Gestión de Productos y Divisas

API RESTful desarrollada en **Laravel 13** con **PHP 8.3** para la gestión de productos, sus costos asociados y la administración de precios en múltiples divisas.

---

## Requisitos del Sistema

- **PHP**: ^8.3 (extensiones requeridas: `pdo_mysql`)
- **Composer**: ^2.0
- **Laravel**: Framework 13.x

---

## Instalación y Configuración

1. **Clonar el repositorio:**
   ```bash
   git clone <URL_DE_TU_REPOSITORIO>
   cd prueba-backend
   ```

2. **Instalar dependencias:**
   ```bash
   composer install
   ```

3. **Configurar variables de entorno:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Ejecutar migraciones y datos iniciales:**
   *Las divisas base (USD, EUR) se insertan automáticamente mediante la migración inicial.*
   ```bash
   php artisan migrate
   ```

5. **Iniciar el servidor de desarrollo:**
   ```bash
   php artisan serve
   ```

La API estará disponible en: `http://127.0.0.1:8000/api/`

---

## Documentación de Endpoints

### 1. Productos (`/api/products`)

| Método | Endpoint | Descripción |
| `GET` | `/api/products` | Listar todos los productos con sus precios y divisas |
| `POST` | `/api/products` | Crear un nuevo producto |
| `GET` | `/api/products/{id}` | Obtener detalle de un producto específico |
| `PUT` | `/api/products/{id}` | Actualizar un producto existente |
| `DELETE` | `/api/products/{id}` | Eliminar un producto |

#### Ejemplo de Payload: `POST /api/products`
```json
{
  "name": "Teclado Mecánico",
  "description": "Teclado RGB inalámbrico",
  "price": 45.00,
  "currency_id": 1,
  "tax_cost": 5.00,
  "manufacturing_cost": 20.00
}
```

---

### 2. Precios de Productos (`/api/products/{id}/prices`)

| Método | Endpoint | Descripción |
| `GET` | `/api/products/{id}/prices` | Obtener la lista de precios asociados a un producto |
| `POST` | `/api/products/{id}/prices` | Agregar un precio en otra divisa para un producto |
| `DELETE` | `/api/products/{id}/prices/{price_id}` | Eliminar un precio específico del producto |

#### Ejemplo de Payload: `POST /api/products/1/prices`
```json
{
  "currency_id": 2,
  "price": 42.00
}
```

---

## Manejo Global de Excepciones

La API cuenta con interceptores de excepciones personalizados en `bootstrap/app.php` para asegurar respuestas JSON uniformes:

- **`404 Not Found`**: Disparado cuando una ruta o recurso no existe (`ModelNotFoundException` / `NotFoundHttpException`).
  ```json
  {
      "success": false,
      "message": "El recurso solicitado no fue encontrado."
  }
  ```
- **`422 Unprocessable Entity`**: Disparado automáticamente por las Form Requests cuando no se superan las reglas de validación.

---

## 📖 Pruebas Rápidas con cURL

### Operaciones CRUD
```bash
# Listar productos
curl -X GET http://localhost:8000/api/products \
     -H "Accept: application/json"

# Crear producto
curl -X POST http://localhost:8000/api/products \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{
       "name": "Teclado Mecánico",
       "description": "Teclado RGB inalámbrico",
       "price": 45.00,
       "currency_id": 1,
       "tax_cost": 5.00,
       "manufacturing_cost": 20.00
     }'

# Actualizar producto
curl -X PUT http://localhost:8000/api/products/1 \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{
       "name": "Teclado Mecánico Pro",
       "description": "Teclado RGB inalámbrico con switches rojos",
       "price": 55.00,
       "currency_id": 1,
       "tax_cost": 6.00,
       "manufacturing_cost": 22.00
     }'

# Eliminar producto
curl -X DELETE http://localhost:8000/api/products/1 \
     -H "Accept: application/json"
```

### Pruebas de Respuestas de Error

```bash
# Probar error 404 (Recurso no encontrado)
curl -X GET http://localhost:8000/api/products/99999 \
     -H "Accept: application/json"

# Probar error 422 (Fallo de validación)
curl -X POST http://localhost:8000/api/products \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{"name": "", "price": "texto-invalido"}'
```

---

## Criterios de Evaluación Cubiertos

- **Correctitud**: Implementación completa de operaciones CRUD para productos y gestión multidivisa mediante Eloquent ORM.
- **Claridad**: Estructura de respuestas JSON claras y estándar en todos los endpoints HTTP.
- **Organización**: Separación de responsabilidades utilizando Form Requests para la validación y controladores dedicados en 
`app/Http/Controllers/Api/`.
- **Seguridad**:
  - Sanitización y validación estricta de parámetros entrantes.
  - Protección de asignación masiva en los modelos Eloquent (`$fillable`).
  - Control de excepciones HTTP (`404 Not Found`, `422 Unprocessable Entity`).
