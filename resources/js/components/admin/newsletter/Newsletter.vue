<template>
  <div class="container">
    <form>
      <div class="form-group col-md-12">
        <label for="exampleFormControlSelect2">Multiple select</label>
        <select
          multiple
          v-model="emailList"
          class="form-control"
          id="exampleFormControlSelect2"
        >
          <option v-for="list in lists" v-bind:key="list.email">
            {{ list.email }}
          </option>
        </select>
      </div>
      <div class="form-group col-md-12">
        <label for="exampleFormControlInput1">Subject</label>
        <input
            type="text"
            v-model="subject"class="form-control"
            id="exampleFormControlInput1"
            placeholder="Subject"
        />
      </div>
      <v-col cols="12">
        <vue-editor v-model="description" label="Description"></vue-editor>
      </v-col>
      <div class="col-md-12">
        <button
          type="button"
          class="btn btn-info float-right"
          @click="SendEmail()"
        >
          Send
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      lists: [],
      emailList: [],
      subject: "",
      description: "",
    };
  },
  mounted() {
    this.initialize();
  },
  methods: {
    initialize() {
      axios
          .get("/admin/newsletter_list")
          .then((response) => {
            this.lists = response.data.data;
          })
          .catch((error) => {
            console.log(error.message);
          });
    },
    formData() {
      return {
        Subject: this.subject,
        EmailList: this.emailList,
        Description: this.description,
        // product_id: this.product_detail,
      };
    },
    SendEmail() {
      axios
        .post("/admin/SendNewsletterEmail", this.formData())
        .then((response) => {
          console.log(response.data);
          this.$toasted.show(response.data);
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
  },
};
</script>

<style>
</style>