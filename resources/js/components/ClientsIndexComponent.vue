<template>
  <div class="container">
    <table width="100%" border="1">
      <thead>
        <tr>
          <th>Id</th>
          <th>Date created</th>
          <th>Name</th>
          <th>Token</th>
          <th>Email</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>        
      </thead>
      <tbody>
        <tr v-for="(client, idx) in clients" :key="idx">
          <td>{{client.id}}</td>
          <td>{{client.created_at}}</td>
          <td>{{client.name}}</td>
          <td>{{client.token}}</td>
          <td>{{client.email}}</td>
          <td v-if="client.active">Active</td>
          <td v-else>Inactive</td>
          <td><a>Ver</a> / <a>Editar</a></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
    props: {
      clients: Object, 
    },
    mounted() {
        console.log("paso por aqui");
    },
  }
</script>
<style scoped>
table {
  border: 2px solid #2176bd;
  border-radius: 3px;
  background-color: #fff;
}

th {
  background-color: #227dc7;
  /*color: rgba(255,255,255,0.66);*/
  color:#fff;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

td {
  background-color: #f9f9f9;
}

th, td {
  min-width: 120px;
  padding: 10px 20px;
}

th.active {
  color: #fff;
}

th.active .arrow {
  opacity: 1;
}

.arrow {
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  margin-left: 5px;
  opacity: 0.66;
}

.arrow.asc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-bottom: 4px solid #2176bd;
}

.arrow.dsc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #2176bd;
}
</style>