<template>
  <div class="cotainer">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <h3 class="card-header text-center">Login</h3>
          <div class="card-body">
            <form method="POST" action="../login">
              <input name="_token" type="hidden" :value="csrf" />
              <div class="form-group mb-3">
                <input
                  type="text"
                  placeholder="Email"
                  id="email"
                  class="form-control"
                  name="email"
                  required
                  autofocus
                />
              </div>

              <div class="form-group mb-3">
                <input
                  type="password"
                  placeholder="Password"
                  id="password"
                  class="form-control"
                  name="password"
                  required
                />
              </div>

              <div class="d-grid mx-auto">
                <button type="submit" class="btn btn-dark btn-block">
                  Sign in
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
