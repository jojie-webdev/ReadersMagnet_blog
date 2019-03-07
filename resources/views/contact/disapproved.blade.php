
<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>

    <p>Hi, <span>{{ $name }}</span></p>
    <p>Thank you for submitting your article!
Upon review, your post has not met the following guideline(s):
    </p>
    <p>
        {{$reason}}
    </p>
    <p>
        Meeting the guidelines are vital in getting you and your book found online faster.
        Below is a quick reference of what to follow when submitting an article.
    </p>
    <img src="{{ asset('/images/RM-Infographics-Article-Submission-Guidelines.jpg')}}">

    <p>Feel free to visit https://readersmagnet.club and submit a new post.</p>

    <p>Regards,</p>
    <img src="{{ asset('/images/readersmagnet-logo.png')}}">
    <p>Phone	800-805-0762</p>
    <p>Address	10620 Treena St. STE 230 San Diego, CA 92131</p>
    <p>Website	www.readersmagnet.com</p>


</body>
</html>