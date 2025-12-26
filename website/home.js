const containter=document.querySelector('.container');
const LoginLink=document.querySelector('.SignInLink')
const RegisterLink=document.querySelector('.SignUpLink')
RegisterLink.addEventListener('click',()=>{
    containter.classList.add('active');
}) 
LoginLink.addEventListener('click',()=>{
    containter.classList.remove('active');
}) 