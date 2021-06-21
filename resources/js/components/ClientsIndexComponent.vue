<template>
  <div class="container">
    <h5>List of Clients</h5>
    <table width="100%" border="1">
      <thead>
        <tr>
          <th> 
          <span class="arrow" >
          </span>
          </th>
        </tr>        
      </thead>
      <tbody>
        <tr>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
    props: {
      data: [{ id: '1', 'name': Infinity }],
      columns: ['Id','Name'],
      filterKey: ''
    },
    mounted() {
        console.log('Component mounted.')
    },
    
  }
</script>
