
<div class="clnbd c8tys c58e1 c9gkl cqikb">
    <!-- Page wrapper -->
    <div class="c4ihh cm95r ckoci cbp69 csqne">

        <!-- Site header -->
        <header class="c48fs cv0zi c2f91">
            <div class="c9zbf cfacu c0spu cnm0k">
                <div class="c1ls3 cqho4 clp4z csqne cqs3o">

                    <!-- Site branding -->
                    <div class="cqfuo cg571 rounded-full shrink-0 grow-0 h-8 w-8">
                        <!-- Logo -->
                        <a class="cdfr0 cq3a6" href="#" aria-label="{{ filament()->getBrandName() }}">
                            @if ($favicon = filament()->getFavicon())
                                <img src="{{ $favicon }}" alt="{{ filament()->getBrandName() }}"/>
                            @endif
                        </a>
                    </div>

                    <!-- Desktop navigation -->
                    <nav class="csqne c8c54">

                        <!-- Desktop sign in links -->
                        <ul class="cqho4 c392o cmh34 csqne c8c54">
                            <li>
                                <a class="cxymg cvqf0 cqho4 crqt4 c38bd ckc7d csqne cr309 ciyzd" href="{{filament()->getPanel('candidate')->getLoginUrl()}}">Sign in</a>
                            </li>
                            <li>
                                <a class="crp1m czlxp chrwa cxa4q c9csv ckncn c0ndj c91mf chlg0" href="{{filament()->getPanel('candidate')->getRegistrationUrl()}}">Sign up</a>
                            </li>
                        </ul>

                    </nav>

                </div>
            </div>
        </header>

        <!-- Page content -->
        <main class="c8c54">

            <!-- Page content -->
            <section>
                <div class="c9zbf cfacu c0spu cnm0k">
                    <div class="cijys c73bz crfxz ctz8u">

                        <div class="cysna cqlk9">

                            <!-- Sidebar -->
                            <aside class="cws3b cudyc c86lp c8ts0 ch5fv cpai1 c9434 coxki">
                                <div class="cfy4w c3ccr">
                                    <div class="c9l7w cx3rm cnr9b clk58 ck3qj cegg7">
                                        <div class="cf3hn cs792 c7764 csqne">
                                            <ul class="c00re cw8gy cbp69">
                                                <li class="cqho4 csqne">
                                                    <svg class="ccrmq cqfuo caano" width="14" height="14" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.707 4.293a1 1 0 0 0-1.414 1.414L10.586 8H2V2h3a1 1 0 1 0 0-2H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h8.586l-2.293 2.293a1 1 0 1 0 1.414 1.414l4-4a1 1 0 0 0 0-1.414l-4-4Z"></path>
                                                    </svg>
                                                    <span class="cza13 ckc7d">
                                                        {{\Carbon\Carbon::createFromTimeStamp(strtotime($jobDetails->created_at))->calendar()}}
                                                    </span>
                                                </li>
                                                <li class="cqho4 csqne">
                                                    <svg class="ccrmq cqfuo caano" width="14" height="16" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="7" cy="7" r="2"></circle>
                                                        <path d="M6.3 15.7c-.1-.1-4.2-3.7-4.2-3.8C.7 10.7 0 8.9 0 7c0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.9-.7 3.7-2.1 5-.1.1-4.1 3.7-4.2 3.8-.4.3-1 .3-1.4-.1Zm-2.7-5 3.4 3 3.4-3c1-1 1.6-2.2 1.6-3.6 0-2.8-2.2-5-5-5S2 4.2 2 7c0 1.4.6 2.7 1.6 3.7 0-.1 0-.1 0 0Z"></path>
                                                    </svg>
                                                    <span class="cza13 ckc7d">
                                                        {{$jobDetails->RemoteJob === 1 ? 'Fully Remote' : 'On-site'}}
                                                    </span>
                                                </li>
                                                <li class="cqho4 csqne">
                                                    <svg class="ccrmq cqfuo caano" width="16" height="12" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15 0H1C.4 0 0 .4 0 1v10c0 .6.4 1 1 1h14c.6 0 1-.4 1-1V1c0-.6-.4-1-1-1Zm-1 10H2V2h12v8Z"></path>
                                                        <circle cx="8" cy="6" r="2"></circle>
                                                    </svg>
                                                    <span class="cza13 ckc7d">{{$jobDetails->Salary}}</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="cglzl c0spu c7764">
                                            <a class="ch5p0 comj7 c3fma cfkyn cv0zi cq3a6 csg05" href="{{route('career.job_apply', [$jobDetails->JobOpeningSystemID])}}">
                                                Apply Now <span class="ciidb ci5s6 c8b8n cv4h1 chdfx ct9wm c6gnl">-&gt;</span>
                                            </a>
                                        </div>

                                        <div class="coaue c7764 c0spu">
                                            <a class="cxymg cvqf0 crqt4 ckc7d" href="#0">Visit Website</a>
                                        </div>
                                        <div class="cqho4 cjs1m csqne c7764 c0spu">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share " viewBox="0 0 16 16"> <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/> </svg>
                                            </div>
                                            <ul class="c00re cn13m">
                                                <li>
                                                    <a class="cjp65 chq2y cvqf0 cs792 cs8ht cqho4 c6eaa chdfx ct9wm cdo22 csqne" href="https://twitter.com/intent/tweet?url={{url()->current()}}&source=CareerSite&text={{config('app.name')}} is Hiring. Know more about the job opening here: &via={{config('app.name')}}&hashtag={{config('app.name')}}" aria-label="Twitter">
                                                        <svg class="cmig7 c5ey2 c7gev" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M24 11.5c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4 0 1.6 1.1 2.9 2.6 3.2-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H8c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4c.7-.5 1.3-1.1 1.7-1.8z"></path>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="cjp65 chq2y cvqf0 cs792 cs8ht cqho4 c6eaa chdfx ct9wm cdo22 csqne" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}?source=CareerSite" aria-label="Facebook">
                                                        <svg class="cmig7 c5ey2 c7gev" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.023 24 14 17h-3v-3h3v-2c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V14H21l-1 3h-2.72v7h-3.257Z"></path>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="cjp65 chq2y cvqf0 cs792 cs8ht cqho4 c6eaa chdfx ct9wm cdo22 csqne" href="https://telegram.me/share/url?url={{url()->current()}}&source=CareerSite&text={{config('app.name')}} is Hiring. Know more about the job opening here:" aria-label="Telegram">
                                                        <svg class="cmig7 c5ey2 c7gev" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M22.968 10.276a.338.338 0 0 0-.232-.253 1.192 1.192 0 0 0-.63.045s-14.019 5.038-14.82 5.596c-.172.121-.23.19-.259.272-.138.4.293.573.293.573l3.613 1.177a.388.388 0 0 0 .183-.011c.822-.519 8.27-5.222 8.7-5.38.068-.02.118 0 .1.049-.172.6-6.606 6.319-6.64 6.354a.138.138 0 0 0-.05.118l-.337 3.528s-.142 1.1.956 0a30.66 30.66 0 0 1 1.9-1.738c1.242.858 2.58 1.806 3.156 2.3a1 1 0 0 0 .732.283.825.825 0 0 0 .7-.622s2.561-10.275 2.646-11.658c.008-.135.021-.217.021-.317a1.177 1.177 0 0 0-.032-.316Z"></path>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="cjp65 chq2y cvqf0 cs792 cs8ht cqho4 c6eaa chdfx ct9wm cdo22 csqne" href="https://www.linkedin.com/sharing/share-offsite/?url={{url()->current()}}?source=CareerSite" aria-label="Linkedin">
                                                        <svg class="cmig7 c5ey2 c7gev" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg">
                                                            <path transform="translate(-6.5, -5.326)" d="M14 19H18V34H14zM15.988 17h-.022C14.772 17 14 16.11 14 14.999 14 13.864 14.796 13 16.011 13c1.217 0 1.966.864 1.989 1.999C18 16.11 17.228 17 15.988 17zM35 24.5c0-3.038-2.462-5.5-5.5-5.5-1.862 0-3.505.928-4.5 2.344V19h-4v15h4v-8c0-1.657 1.343-3 3-3s3 1.343 3 3v8h4C35 34 35 24.921 35 24.5z"></path>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="cjp65 chq2y cvqf0 cs792 cs8ht cqho4 c6eaa chdfx ct9wm cdo22 csqne clipboard" href="#" aria-label="Link" id="shareLink"  x-clipboard.raw="{{url()->current()}}?source=CareerSite" wire:click="copiedShareLink">
                                                        <svg class="cmig7 c5ey2 c7gev" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <g transform="translate(1.5, 1.326)">
                                                                <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/> <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>
                                                            </g>
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </aside>

                            <!-- Main content -->
                            <div class="cmgbb">
                                <!-- Job description -->
                                <div class="ctz8u">
                                    <div class="cnog5">
                                        <a class="cvqf0 crqt4" href="{{route('career.landing_page')}}"><span class="c8b8n">&lt;-</span> All Jobs</a>
                                    </div>
                                    <h1 class="c5zpx c9gkl c8hbn cn95v">{{$jobDetails->postingTitle}}</h1>
                                    <!-- Job description -->
                                    <div class="c5rk9 coxki">
                                        {{--<div>
                                            <h3 class="c8tys c89yv chhg4 codx4">About Us</h3>
                                            <div class="cdfls cttum">
                                                <p>In the world of AI, behavioural predictions are leading the charge to better machine learning.</p>
                                                <p>There is so much happening in the AI space. Advances in the economic sectors have seen automated business practices rapidly increasing economic value. While the realm of the human sciences has used the power afforded by computational capabilities to solve many human based dilemmas. Even the art scene has adopted carefully selected ML applications to usher in the technological movement.</p>
                                                <p>As a Senior Client Engineer, you'll work alongside other engineers, designers, and product managers to tackle everything from huge company initiatives to modest but important bug fixes, from start to finish. You'll also collaborate with your product team on discovery, helping to assess the direction and feasibility of product changes. And, perhaps most importantly, you'll actively contribute to the evolution of the culture and processes of a growing engineering team.</p>
                                            </div>
                                        </div>--}}
                                        <div>
                                            <h3 class="c8tys c89yv chhg4 codx4">Job Description</h3>
                                            <div class="cdfls cttum">
                                                {!! $jobDetails->JobDescription !!}
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="c8tys c89yv chhg4 codx4">Requirements</h3>
                                            <div class="cdfls cttum cbjmj ckxyp ">
                                                {!! $jobDetails->JobRequirement !!}
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="c8tys c89yv chhg4 codx4">Benefits</h3>
                                            <div class="cdfls cttum cbjmj ckxyp">
                                                {!! $jobDetails->JobBenefits !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
