<template>
    <div class="authentication">
        <div class="modal fade" id="forgot" role="dialog" aria-hidden="true">
            <div class="modal-dialog auth-modal modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-block px-4 px-sm-5 pt-5 bb-0">
                        <a href="javascript:void(0);" class="close d-sm-none" data-dismiss="modal">&times;</a>
                        <h4 class="font-weight-bold mb-2"> Forgot password</h4>
                        <p>Enter your email address and we will send you instructions on how to reset your password.</p>
                    </div>
                    <div class="modal-body px-4 px-sm-5 pt-0">
                        <ul class="nav nav-tabs line-tabs mb-3" id="sign" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" id="reset-password-request-tab" data-toggle="tab" href="#resetPasswordRequest" role="tab" aria-controls="login" aria-selected="true">Request Reset Password</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" id="reset-password-tab" data-toggle="tab" href="#resetPassword" role="tab" aria-controls="register" ref="resetPassword" aria-selected="false">Forget Request</a></li>
                        </ul>
                        <div class="tab-content" id="signContent">
                            <div class="tab-pane fade show active" id="resetPasswordRequest" role="tabpanel" aria-labelledby="reset-password-request-tab">
                                <form class="pb-5" v-on:submit.prevent="resetPasswordRequest">
                                    <div class="form-group">
                                        <label for="useremail" class="form-control-label">Email</label>
                                        <input id="useremail" type="text" v-model="user.email" placeholder="Enter email" class="form-control"  />
                                        <div class="invalid-feedback" v-if="errors.email">{{errors.email[0]}}</div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block" ref="btnSubmit">Reset Password</button>
                                    <div class="form-group text-center mt-3">
                                        <a href="javascript: void(0);" class="link" data-dismiss="modal" data-toggle="modal" data-target="#sign_in" ref="loginBtnAfterForgotPassword">Back to login</a>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="resetPassword" role="tabpanel" aria-labelledby="reset-password-request-tab">
                               <form class="pb-5" v-on:submit.prevent="resetPassword">
                                    <div class="form-group">
                                        <label for="resetPassword" class="form-control-label">Email</label>
                                        <input id="resetPassword" type="text" v-model="user.email" placeholder="Enter email" class="form-control"  />
                                        <div class="invalid-feedback" v-if="errors.email">{{errors.email[0]}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="form-control-label">Verification Code</label>
                                        <input id="username" type="text" v-model="user.verification_code" placeholder="Enter verification code" class="form-control"  />
                                        <div class="invalid-feedback" v-if="errors.verification_code">{{errors.verification_code[0]}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Password</label>
                                        <input id="password" type="password" v-model="user.password" placeholder="Enter password" class="form-control"  />
                                        <div class="invalid-feedback" v-if="errors.password">{{errors.password[0]}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmationpassword" class="form-control-label">Password Confirmation</label>
                                        <input id="confirmationpassword" type="password" v-model="user.password_confirmation" placeholder="Password Confirmation" class="form-control"  />
                                        <div class="invalid-feedback" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                                    <!-- <div class="auth-modal-foot mt-4">
                                        <div class="mb-4 text-center">Or via Social</div>
                                        <div class="auth-modal-foot--btn">
                                            <a href="#" class="btn btn-icon btn-facebook"><i class="ion-logo-facebook"></i> <span>Facebook</span> </a>
                                            <a href="#" class="btn btn-icon btn-twitter"><i class="ion-logo-twitter"></i> <span>Twitter</span></a>
                                        </div>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="modal-header d-block px-4 px-sm-5 pt-5 bb-0">
                            <a href="javascript:void(0);" class="close d-sm-none" data-dismiss="modal">&times;</a>
                            <h4 class="font-weight-bold mb-2">Sign In</h4>
                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consequuntur deserunt dolore!</p> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" ref="authModalCloseButton">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body px-4 px-sm-5 pt-0">
                            <!-- <ul class="nav nav-tabs line-tabs mb-3" id="sign" role="tablist">
                                <li class="nav-item" role="presentation"><a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true" ref="loginBtn">Sign In</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Sign Up</a></li>
                            </ul> -->
                            <div class="tab-content" id="signContent">
                                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                    <form class="pb-5" v-on:submit.prevent="login">
                                        <div class="form-group">
                                            <label for="usernameLogin" class="form-control-label">Email</label>
                                            <input id="usernameLogin" type="text" v-model="user.email" placeholder="Enter email" class="form-control"  />
                                            <div class="invalid-feedback" v-if="action === 'login' && errors.email">{{errors.email[0]}}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="passwordLogin" class="form-control-label">Password</label>
                                            <div class="form-control-icon form-control-icon_right">
                                                <input id="passwordLogin" :type="loginPasswordHidden ? 'password' : 'text'" v-model="user.password" placeholder="Enter password" class="form-control"  />
                                                <button type="button" class="form-control-icon_wrapper icon-eye" v-on:click="loginPasswordHidden = !loginPasswordHidden">
                                                    <span><i v-if="loginPasswordHidden" class="eye-open icofont-eye"></i> <i v-else class="eye-close icofont-eye-blocked" id="registerPasswordVisibleCharacters"></i></span>
                                                </button>
                                                <div class="invalid-feedback" v-if="action === 'login' && errors.password">{{errors.password[0]}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between">
                                            <div class="checkbox">
                                                <input id="remember" type="checkbox" v-model="user.remember_me" value="true" />
                                                <label for="remember">Remember me</label>
                                            </div>
                                            <a href="javascript: void(0);" class="link" data-dismiss="modal" data-toggle="modal" data-target="#forgot" ref="">Forgot Password?</a>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                        <!-- <div class="auth-modal-foot mt-4">
                                            <div class="mb-4 text-center">Or via Social</div>
                                            <div class="auth-modal-foot--btn">
                                                <a href="#" class="btn btn-icon btn-facebook"><i class="ion-logo-facebook"></i> <span>Facebook</span> </a>
                                                <a href="#" class="btn btn-icon btn-twitter"><i class="ion-logo-twitter"></i> <span>Twitter</span></a>
                                            </div>
                                        </div> -->
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form v-on:submit.prevent="register" class="pb-5">
                                        <div class="form-group">
                                            <label for="firstNameRegister" class="form-control-label">First Name</label>
                                            <input id="firstNameRegister" type="text" v-model="user.first_name" placeholder="Enter your first name" class="form-control" />
                                            <div class="invalid-feedback" v-if="action === 'register' && errors.first_name">{{errors.first_name[0]}}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastNameRegister" class="form-control-label">Last Name</label>
                                            <input id="lastNameRegister" type="text" v-model="user.last_name" placeholder="Last name" class="form-control" />
                                            <div class="invalid-feedback" v-if="action === 'register' && errors.last_name">{{errors.last_name[0]}}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="usernameRegister" class="form-control-label">Email</label>
                                            <input id="usernameRegister" type="text" v-model="user.email" placeholder="Enter email/phone" class="form-control" />
                                            <div class="invalid-feedback" v-if="action === 'register' && errors.email">{{errors.email[0]}}</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="passwordRegister" class="form-control-label">Password</label>
                                            <div class="form-control-icon form-control-icon_right">
                                                <input id="passwordRegister" :type="registerPasswordHidden ? 'password' : 'text'" v-model="user.password" placeholder="Enter password" class="form-control" />
                                                <button type="button" class="form-control-icon_wrapper icon-eye" v-on:click="registerPasswordHidden = !registerPasswordHidden">
                                                    <span><i v-if="registerPasswordHidden" class="eye-open icofont-eye"></i> <i v-else class="eye-close icofont-eye-blocked" id="registerPasswordVisibleCharacters"></i></span>
                                                </button>
                                                <div class="invalid-feedback" v-if="action === 'register' && errors.password">{{errors.password[0]}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPasswordRegister" class="form-control-label">Confirm Password</label>
                                            <div class="form-control-icon form-control-icon_right">
                                                <input id="confirmPasswordRegister" :type="registerConfirmPasswordHidden ? 'password' : 'text'" v-model="user.password_confirmation" placeholder="Re-type password" class="form-control"  />
                                                <button type="button" class="form-control-icon_wrapper icon-eye" v-on:click="registerConfirmPasswordHidden = !registerConfirmPasswordHidden">
                                                    <span><i v-if="registerConfirmPasswordHidden" class="eye-open icofont-eye"></i> <i v-else class="eye-close icofont-eye-blocked" id="registerPasswordVisibleCharacters"></i></span>
                                                </button>
                                                <div class="invalid-feedback" v-if="action === 'register' && errors.password_confirmation">{{errors.password_confirmation[0]}}</div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label class="form-control-label">Register as?</label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" v-model="user.role" value="doctor" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">Doctor</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" v-model="user.role" value="user" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">User</label>
                                            </div>
                                            <div class="invalid-feedback" v-if="action === 'register' && errors.role">{{errors.role[0]}}</div>
                                        </div> -->
                                        <button type="submit" class="btn btn-primary btn-block mt-4">Register</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import * as authService from '../../services/auth_service';
    export default {
        data() {
            return {
                user: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    role: 'doctor',
                    remember_me: false,
                    verification_code: '',
                },

                loginPasswordHidden: true,
                registerPasswordHidden: true,
                registerConfirmPasswordHidden: true,
                action: '',

                errors: {}
            }
        },
        methods: {
            login: async function() {
                try {
                    this.errors = {};
                    this.$store.state.isLoading = true;

                    const response = await authService.login(this.user);
                    this.$router.push('/'+response.data.user.role);

                    this.$store.state.isLoading = false;
                } catch (error) {
                    switch (error.response.status) {
                        case 422:
                            this.action = 'login';
                            this.errors = error.response.data.errors;
                            break;
                        case 401:
                            this.errors = {};
                            this.flashMessage.info({
                                message: error.response.data.message,
                                time: 5000
                            });
                            break;
                        default:
                            this.errors = {};
                            this.flashMessage.error({
                                message: "Some error occurred please try again",
                                time: 5000
                            });
                            break;
                    }

                    this.$store.state.isLoading = false;
                }
            },
            register: async function() {
                try {
                    this.errors = {};
                    await authService.register(this.user);
                    this.flashMessage.info({
                        message: 'Registration successfuly, Please try to signin now',
                        time: 5000
                    });
                    this.$refs.loginBtn.click();
                } catch (error) {
                    switch (error.response.status) {
                        case 422:
                            this.action = 'register';
                            this.errors = error.response.data.errors;
                            break;
                        case 500:
                            this.flashMessage.error({
                                message: error.response.data.message,
                                time: 5000
                            });
                            break;
                        default:
                            this.flashMessage.error({
                                message: 'Some error occurred, Please try again!',
                                time: 5000
                            });
                            break;
                    }
                }
            },
            resetPasswordRequest: async function() {
                try {
                    this.$store.state.isLoading = true;
                    this.errors = {};
                    const response = await authService.resetPasswordRequest(this.user);
                    this.flashMessage.success({
                        message: response.data.message,
                        time: 5000
                    });

                    this.$store.state.isLoading = false;
                    this.$refs.resetPassword.click();
                } catch (error) {
                    console.log(error)
                    switch (error.response.status) {
                        case 422:
                            this.errors = error.response.data.errors;
                            break;
                        default:
                            this.flashMessage.error({
                                message: 'Some error occurred, Please try again!',
                                time: 5000
                            });
                            break;
                    }

                    this.$store.state.isLoading = false;
            }
        },
        resetPassword: async function() {
             try {
                    this.$store.state.isLoading = true;
                    this.errors = {};
                    const response = await authService.resetPassword(this.user);
                    console.log(response)
                    this.flashMessage.success({
                        message: response.data.message,
                        time: 5000
                    });

                    this.$store.state.isLoading = false;
                    this.$refs.loginBtnAfterForgotPassword.click();
                } catch (error) {
                    console.log(error)
                    switch (error.response.status) {
                        case 422:
                            this.errors = error.response.data.errors;
                            break;
                             case 401:
                            this.errors = error.response.data.errors;
                            break;
                        default:
                            this.flashMessage.error({
                                message: 'Some error occurred, Please try again!',
                                time: 5000
                            });
                            break;
                    }

                    this.$store.state.isLoading = false;
            }
        }
    }
};
</script>
