
# Whistle It



## API Reference
##  User
#### Create User

```http
  Post /user
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required** |
| `email`| `email`  | **Required**  |
| `password`| `password`  | **Required**  |


#### Login

```http
  post /login
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `email` | **Required**|
| `password`      | `password` | **Required**|

#### Show all Users

```http
  GET /user/show
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |


##### Returns all User If allowed
 
### Delete
```http
  GET /user/delete
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `email` | **Required**|


##### Delete User If allowed 
## WorkSpace
#### Create WorkSpace
```http
  GET /workSpace/add
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**|
| `description`      | `string` | **Required**|

#### Show WorkSpace
```http
  GET /workSpace/show
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |


##### Return all workSpace if allowed

#### Show WorkSpace
```http
  GET workSpace/addmembers
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `email` | **Required**|


##### 
