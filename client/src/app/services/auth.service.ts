
export class AuthService {
  isAuth = false;
  signIn() {
    return new Promise(
      (resolve, reject) => {
          this.isAuth = true;
          resolve(true);
      }
      );
  }
  // Disconnection
  signOut() {
    this.isAuth = false;
  }
}
