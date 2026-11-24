# API examples

Base URL: `http://127.0.0.1:8000/api`

## Create sample record

```http
POST /items
Accept: application/json
Content-Type: application/json

{
  "sku": "KB-104",
  "name": "Wireless keyboard",
  "quantity": 18,
  "reorder_level": 6,
  "unit_price": "24.90"
}
```

## Validation

Submit an empty object and the API responds with HTTP 422 and field-level validation errors.
