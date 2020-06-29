@extends('layouts.app')

@section('content')
    <style>
        p{
            /*color: black;*/
        }
    </style>
    <div class="container">
            <h1 style="font-family: 'Comic Sans MS'" class="text-center">{{$title}}</h1>
    <div class="jumbotron text-center" style="margin-top: 50px;max-height: 873px">
        <div class="row">
            <div class="col-xl-6 col-sm-6" style="margin-top: 30px">
                <img class="embed-responsive offset-2" style="width: 70%; height: 70%;margin-top: -40px" src="/storage/cover_images/lilian.jpeg">
                <br/>
                <strong style="font-family: 'Comic Sans MS';color: black">Author: Ms Lilian Kimeto</strong>
            </div>
            <div class="col-xl-6 col-sm-6  py-sm-4 py-4">
                <div>
                    <p style="text-align:center; font-family: 'Comic Sans MS'; color: black">I am a journalist and teacher having trained in both areas.<br>
                        As a journalist I create content that will help citizens understand <br>  why they need to improve their
                        own lives.<br>
                        I create content that informs, educates and entertain my audience.
                    </p>
                    <br>
                </div>
                <div>
                    <hr>
                    <b style="font-family: 'Comic Sans MS';color: black">My Passion</b><br/>
                    <hr>
                    <div style="font-family: 'Comic Sans MS';color: black" class="text-wrap">
                        I am passionate about using technology and in using it to tell stories,coach people on how they can harness
                        technology to better their lives <br>and to mentor young generation on values that lead them to better lives
                    </div>
               <br>
                </div>
                <hr>
            </div>
        </div>
    </div>


    {{--<div class="jumbotron text-center">
        <h1>{{$title}}</h1>
            <div class="row">
                <div class="col-6">
                    <img class="embed-responsive" style="width:50%; height: 50%" src="/storage/cover_images/lilian.jpeg">
                        I am a journalist and teacher having trained in both areas.
                        As a journalist I create content that will help citizens understand <br>  why they need to improve their
                        own lives.
                        I create content that informs, educates and entertain my audience.</div>
                </div>

                <div class="col-6">
                 <br/>
                    <div>
                        <b>MY Passion</b><br/>
                         - Use technology to tell stories<br>
                         - Coach people on how to harness technology<br>
                         - Mentor young people on values so that they can lead quality life.<br>
                    </div><br/>
                    <div>
                        <b>My Interest in Society</b><br/>
                        - See that we live value driven lives<br>
                        - Harness technology for good<br>
                        - Engage in healthy living habits such as taking part in sports and eating healthy<br>
                    </div>
                </div>
            </div>--}}
        </div>
@endsection
