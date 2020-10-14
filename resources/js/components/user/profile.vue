<template>
  <div class="jumbotron pt-3">
    <h3 class="p-0 m-0">Update your profile.<small>It's always easy</small></h3>
    <form v-on:submit.prevent="updateUserInfo()">
      <hr class="colorgraph"/>
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-6">
          <div class="form-group">
            <label for="">First Name</label>
            <input
                type="text"
                class="form-control input-lg"
                v-model="info.first_name"
            />
          </div>
        </div>

        <div class="col-xs-12 col-sm-8 col-md-6">
          <div class="form-group">
            <label for="">Last Name</label>
            <input
                type="text"
                class="form-control input-lg"
                v-model="info.last_name"
            />
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="">Email</label>
        <input
            type="email"
            name="email"
            id="email"
            class="form-control input-lg"
            readonly
            v-model="info.email"
            required
        />
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-6">
          <div class="form-group">
            <label for="">Street</label>
            <input
                type="text"
                class="form-control input-lg"
                v-model="info.street"
            />
          </div>
        </div>

        <div class="col-xs-12 col-sm-8 col-md-6">
          <div class="form-group">
            <label for="">Address</label>
            <input
                type="text"
                class="form-control input-lg"
                v-model="info.address"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-6">
          <div class="form-group">
            <label for="">City</label>
            <input
                type="text"
                class="form-control input-lg"
                v-model="info.city"
            />
          </div>
        </div>

        <div class="col-xs-12 col-sm-8 col-md-6">
          <div class="form-group">
            <label for="">Phone</label>
            <input
                type="text"
                class="form-control input-lg"
                v-model="info.phone"
            />
          </div>
        </div>
      </div>
      <hr class="colorgraph"/>
      <h5 class="alert alert-success" v-if="savingSuccessful">{{ success }}</h5>
      <div class="row">
        <div class="col-xs-12 col-md-6"></div>
        <div class="col-xs-12 col-md-6">
          <button id="updButton" class="btn btn-success btn-block btn-lg">
            Update
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      savingSuccessful: false,
      success: "",
      errors: {},
      info: [],
    };
  },
  mounted() {
    this.info = this.user;
  },
  methods: {
    updateUserInfo() {
      $("#updButton").text("Updating...");
      axios
          .post("/user/update/", this.info)
          .then((response) => {
            this.savingSuccessful = true;
            this.success = response.data.message;
            console.log(response.data.message);
            $("#updButton").text("Update");
          })

          .catch((error) => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors || {};
            }
          });
    },
  },
};
</script>