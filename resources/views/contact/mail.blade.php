
<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>

    <p>Hi, <span>{{ $name }}</span></p>
    <p>
        Congratulations! We’re glad to inform you that your article has been posted in our Authors’ Lounge.
        You may view the post here: <span>{{ $url }}</span>
    </p>
    <p>
        We will now be sharing your story with the online community. 
        You can do too by clicking on the social media buttons found at the bottom of your article page as shown below.
    </p>
    <img src="{{ asset('/images/social-media.jpg')}}">

    <p>Feel free to visit https://readersmagnet.club and submit a new post.</p>

    <p>Regards,</p>
    <img src="{{ asset('/images/readersmagnet-logo.png')}}">
    <p>Phone	800-805-0762</p>
    <p>Address	10620 Treena St. STE 230 San Diego, CA 92131</p>
    <p>Website	www.readersmagnet.com</p>


</body>
</html>