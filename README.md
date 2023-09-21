
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

#### Show WorkSpacet
```http
  GET workSpace/addmembers
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `email` | **Required**|


## Teams

#### Create Teams
```http
  GET /teams
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required** Team Name|
| `adminEmail`      | `email` | **Required** user email of admin|
| `description`      | `string` | **Required**|
| `workSpace`      | `string` | **Required** Name of workSpace|

#### Add Memebers
```http
  GET /teams/memebers
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `teamMemberEmail`      | `email` | **Required** user email want to added|
| `teamid`      | `id` | **Required**  team id|

#### Add Memebers
```http
  GET /teams/memebers
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `teamMemberEmail`      | `email` | **Required** user email want to added|
| `teamid`      | `id` | **Required**  team id|


#### Remove Memebers
```http
  GET /teams/remove
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `MemberEmail`      | `email` | **Required** user email want to remove|
| `teamid`      | `id` | **Required**  team id|


#### GET Memebers
```http
  GET /teams/memebers
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `id` | **Required** Team id want to fetched|


##### Return all team memebers