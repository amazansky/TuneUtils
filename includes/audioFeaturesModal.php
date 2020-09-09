<div class="modal"><!-- add .is-active to make it show -->
    <div class="modal-background"></div>
    <div class="modal-card">
    <header class="modal-card-head">
        <p class="modal-card-title">What are all these numbers‽</p>
        <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
        These values are provided by Spotify for each song on the platform. The descriptions are as follows.
        <br>Find out more: <a href="https://developer.spotify.com/documentation/web-api/reference/tracks/get-audio-features/">Spotify Web API Documentation - Get Audio Features</a> <sup>[note]</sup>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>mode</td>
                        <td>Mode indicates the modality (major or minor) of a track, the type of scale from which its melodic content is derived.</td>
                    </tr>
                    <tr>
                        <td>acousticness</td>
                        <td>A confidence measure from 0 to 100 of whether the track is acoustic. 100 represents high confidence the track is acoustic.</td>
                    </tr>
                    <tr>
                        <td>danceability</td>
                        <td>Danceability describes how suitable a track is for dancing based on a combination of musical elements including tempo, rhythm stability, beat strength, and overall regularity. A value of 0 is least danceable and 100 is most danceable.</td>
                    </tr>
                    <tr>
                        <td>energy</td>
                        <td>Energy is a measure from 0 to 100 and represents a perceptual measure of intensity and activity. Typically, energetic tracks feel fast, loud, and noisy. For example, death metal has high energy, while a Bach prelude scores low on the scale. Perceptual features contributing to this attribute include dynamic range, perceived loudness, timbre, onset rate, and general entropy.</td>
                    </tr>
                    <tr>
                        <td>instrumentalness</td>
                        <td>Predicts whether a track contains no vocals. “Ooh” and “aah” sounds are treated as instrumental in this context. Rap or spoken word tracks are clearly “vocal”. The closer the instrumentalness value is to 100, the greater likelihood the track contains no vocal content. Values above 50 are intended to represent instrumental tracks, but confidence is higher as the value approaches 100.</td>
                    </tr>
                    <tr>
                        <td>liveness</td>
                        <td>Detects the presence of an audience in the recording. Higher liveness values represent an increased probability that the track was performed live. A value above 80 provides strong likelihood that the track is live.</td>
                    </tr>
                    <tr>
                        <td>loudness</td>
                        <td>The overall loudness of a track in decibels (dB). Loudness values are averaged across the entire track and are useful for comparing relative loudness of tracks. Loudness is the quality of a sound that is the primary psychological correlate of physical strength (amplitude). Values typical range between -60 and 0 db.</td>
                    </tr>
                    <tr>
                        <td>speechiness</td>
                        <td>Speechiness detects the presence of spoken words in a track. The more exclusively speech-like the recording (e.g. talk show, audio book, poetry), the closer to 100 the attribute value. Values above 66 describe tracks that are probably made entirely of spoken words. Values between 33 and 66 describe tracks that may contain both music and speech, either in sections or layered, including such cases as rap music. Values below 33 most likely represent music and other non-speech-like tracks. </td>
                    </tr>
                    <tr>
                        <td>valence</td>
                        <td>A measure from 0 to 100 describing the musical positiveness conveyed by a track. Tracks with high valence sound more positive (e.g. happy, cheerful, euphoric), while tracks with low valence sound more negative (e.g. sad, depressed, angry).</td>
                    </tr>
                    <tr>
                        <td>tempo</td>
                        <td>The overall estimated tempo of a track in beats per minute (BPM). In musical terminology, tempo is the speed or pace of a given piece and derives directly from the average beat duration.</td>
                    </tr>
                </tbody>
            </table>
            <br>[Note] <small>If we're really being pedantic here, some of the values were originally between 0.0 and 1.0 (and you'll find that to be the case if you visit the link above and read the specification of Spotify's audio features object). However, all of them are scaled up by 100x for the purpose for this webapp. Considering the fact that you scrolled down this far, I figured you might want to know that.</small><br><br>
        </div>
    </section>
</div>
