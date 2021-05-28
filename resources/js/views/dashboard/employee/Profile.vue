<template>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-auto mr-auto">
            <h1 class="m-0">Profile</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <div class="profile-tab">
                  <div class="custom-tab-1">
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a
                          href="#my-posts"
                          data-toggle="tab"
                          class="nav-link show active"
                          >Profile</a>
                      </li>
                      <li class="nav-item">
                        <a
                          href="#about-me"
                          data-toggle="tab"
                          class="nav-link"
                          >Change Password</a>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div
                        id="my-posts"
                        class="tab-pane fade active show"
                      >
                        <div class="pt-3">
                          <div class="settings-form">
                            <!-- <h4 class="text-primary">Profile</h4> -->
                            <form v-on:submit.prevent="updateProfile">
                              <div
                                class="form-row mt-3"
                              >
                                <div
                                  class="form-group col-md-6"
                                >
                                  <label>First Name</label>
                                  <input
                                    type="text"
                                    placeholder="First Name"
                                    class="form-control"
                                    v-model="profileData.first_name"
                                  />
                                  <div class="invalid-feedback" v-if="errors.first_name">
                                    {{ errors.first_name[0] }}
                                  </div>
                                </div>
                                <div
                                  class="form-group col-md-6"
                                >
                                  <label>Last Name</label>
                                  <input
                                    type="text"
                                    placeholder="Last Name"
                                    class="form-control"
                                    v-model="profileData.last_name"
                                  />
                                  <div class="invalid-feedback" v-if="errors.last_name">
                                    {{ errors.last_name[0] }}
                                  </div>
                                </div>
                                <div
                                  class="form-group col-md-6"
                                >
                                  <label>Phone</label>
                                  <input
                                    type="text"
                                    placeholder="+92 347 67 78 345"
                                    class="form-control"
                                    v-model="profileData.phone"
                                  />
                                  <div class="invalid-feedback" v-if="errors.phone">
                                    {{ errors.phone[0] }}
                                  </div>
                                </div>
                                <div
                                  class="form-group col-md-6"
                                >
                                  <label>Email</label>
                                  <input
                                    type="email"
                                    placeholder="Email"
                                    class="form-control"
                                    v-model="profileData.email"
                                  />
                                  <div class="invalid-feedback" v-if="errors.email">
                                    {{ errors.email[0] }}
                                  </div>
                                </div>
                              </div>
                              <button
                                class="btn btn-primary"
                                type="submit"
                              >
                                Update Profile
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div id="about-me" class="tab-pane fade">
                        <div class="pt-3">
                          <div class="settings-form">
                            <!-- <h4 class="text-primary">Account Setting</h4> -->
                            <form v-on:submit.prevent="changePassword">
                              <div class="form-row mt-3" >
                                <div class="form-group col-md-6">
                                  <label>Change Password</label >
                                  <input
                                    type="text"
                                    placeholder="Enter Old Password"
                                    class="form-control"
                                    v-model="password.current_password"
                                  />
                                  <div class="invalid-feedback" v-if="errors.current_password">
                                    {{ errors.current_password[0] }}
                                  </div>
                                </div>
                                  <div
                                    class="form-group col-md-6"
                                  >
                                    <label>New  Password</label>
                                    <input
                                      type="text"
                                      placeholder="Enter New Password"
                                      class="form-control"
                                      v-model="password.new_password"
                                    />
                                    <div class="invalid-feedback" v-if="errors.new_password">
                                      {{ errors.new_password[0] }}
                                    </div>
                                  </div>
                                  <div
                                    class="form-group col-md-6"
                                  >
                                    <label>Confirm New Password</label>
                                    <input
                                      type="text"
                                      placeholder="Confirm New Password"
                                      class="form-control"
                                      v-model="password.new_password_confirmation"
                                    />
                                    <div class="invalid-feedback" v-if="errors.new_password_confirmation">
                                      {{ errors.new_password_confirmation[0] }}
                                    </div>
                                  </div>
                              </div>
                              <button class="btn btn-primary"
                                type="submit" >
                                Change Password
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import * as authService from "../../../services/auth_service";
import * as userService from "../../../services/user_service";
export default {
  data() {
      return {
        profileData: {},
        password: {
          current_password: "",
          new_password: "",
          new_password_confirmation: ""
        },
        errors: {}
      };
    },
  
  mounted() {
    this.getProfile();
  },
  methods:{
    getProfile: async function() {
      try {
        const response = await authService.getProfile();
        this.profileData = response.data;
      } catch (error) {
        this.flashMessage.error({
          message: "Some error occurred. please try again.",
          time: 3000
        });
      }
    },
    updateProfile: async function() {
      try {
        this.$store.state.isLoading = true;
        const response = await userService.updateProfile(
          this.profileData
        );
        this.$store.state.isLoading = false;
        this.flashMessage.success({
          message: "Successfully updated.",
          time: 3000
        });
      } catch (error) {
          this.$store.state.isLoading = false;
          switch (error.response.status) {
            case 422:
              this.errors = error.response.data.errors;
              break;

            default:
              this.flashMessage.error({
                message: "Some error occurred. please try again.",
                time: 3000
              });
              break;
          }
          this.flashMessage.error({
            message: "Some error occurred, Please try again.",
            time: 3000
          });
      }
    },
    changePassword: async function() {
      try {
        this.$store.state.isLoading = true;
        const response = await userService.changePassword(
            this.password
        );
        this.$store.state.isLoading = false;
        this.flashMessage.success({
            message: "Password successfully changed.",
            time: 3000
        });
      } catch (error) {
        this.$store.state.isLoading = false;
        switch (error.response.status) {
          case 422:
            this.errors = error.response.data.errors;
            break;

          default:
            this.flashMessage.error({
              message: "Some error occurred. please try again.",
              time: 3000
            });
            break;
        }
        this.flashMessage.error({
          message: "Some error occurred, Please try again.",
          time: 3000
        });
      }
    }
  },
}
</script>