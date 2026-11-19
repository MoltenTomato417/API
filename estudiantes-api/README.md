# API de Estudiantes (Laravel + MySQL + Docker)

Materia: Sistemas Distribuidos. Entrega individual.

## Requisitos
- Docker y Docker Compose

## Ejecución
```bash
git clone <URL_DEL_REPO>
cd estudiantes-api
docker compose up --build
```
Al arrancar, el contenedor `app` espera a que MySQL esté sano, ejecuta
las migraciones y el seeder (5 estudiantes) y publica la API en http://localhost:8000.

## Endpoints
| Método | Ruta                  | Descripción                          |
|--------|-----------------------|--------------------------------------|
| GET    | /api/health           | Estado de la conexión a la BD        |
| GET    | /api/estudiantes      | Listar todos                         |
| POST   | /api/estudiantes      | Crear (validación; 422 si falla)     |
| GET    | /api/estudiantes/{id} | Ver uno (404 si no existe)           |

## Pruebas
```bash
curl http://localhost:8000/api/health
curl http://localhost:8000/api/estudiantes
curl http://localhost:8000/api/estudiantes/1
curl http://localhost:8000/api/estudiantes/999   # 404
curl -X POST http://localhost:8000/api/estudiantes \
  -H "Content-Type: application/json" -H "Accept: application/json" \
  -d '{"nombre":"Pedro Ruiz","correo":"pedro@example.com","programa":"Derecho"}'
# Correo repetido o campos vacíos -> 422
```
> Envía siempre `Accept: application/json` para que los errores de validación
> se devuelvan como JSON.

## ¿Por qué DB_HOST debe ser `db` y no `localhost`?
Cada contenedor tiene su propia interfaz de red, por lo que `localhost` (127.0.0.1)
dentro del contenedor `app` apunta al propio contenedor `app`, donde no hay ningún
MySQL corriendo; la conexión sería rechazada. MySQL vive en otro contenedor (`db`).
Docker Compose crea una red interna compartida por los servicios, con un DNS
integrado que resuelve el nombre de cada servicio a la IP de su contenedor.
Por eso `DB_HOST=db` resuelve al contenedor de MySQL, sin depender de IPs que cambian
entre reinicios. (`localhost` solo funcionaría desde la máquina anfitriona, usando el puerto
publicado.)

## Capturas
Ver carpeta `capturas/`: `docker compose ps` y cada endpoint funcionando.