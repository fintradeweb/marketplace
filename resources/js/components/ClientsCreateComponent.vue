<template>
  <div class="container">
    <form action="" method="POST">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <strong>Name:</strong>
            <input type="text" name="name" class="form-control" placeholder="Name">
          </div>
        </div>
      </div> 
      <div class="row"> 
        <div class="col-md-12">
          <div class="form-group">
            <strong>Email:</strong>
            <input type="text" name="email" class="form-control" placeholder="Email">
          </div>
        </div>
      </div> 
      <div class="row"> 
        <div class="col-md-12 text-center">
          <button type="reset" class="btn btn-secondary">Reset</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
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