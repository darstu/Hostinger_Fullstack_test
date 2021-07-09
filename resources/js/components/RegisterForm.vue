<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <h3 class="card-header text-center">Register User</h3>
          <div class="card-body">
            <form action="../registration" method="POST">
              <input name="_token" type="hidden" :value="csrf" />
              <div class="form-group mb-3">
                <input
                  type="text"
                  placeholder="Full name"
                  id="name"
                  class="form-control"
                  name="name"
                  required
                  autofocus
                />
              </div>

              <div class="form-group mb-3">
                <input
                  type="text"
                  placeholder="Address"
                  id="address"
                  class="form-control"
                  name="address"
                  required
                  autofocus
                />
              </div>

              <div class="form-group mb-3">
                <input
                  type="tel"
                  placeholder="Phone number"
                  id="phone_number"
                  class="form-control"
                  name="phone_number"
                  required
                  autofocus
                />
              </div>

              <div class="form-group mb-3">
                <input
                  type="text"
                  placeholder="Email"
                  id="email_address"
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
                  Sign up
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
